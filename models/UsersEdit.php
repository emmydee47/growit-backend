<?php

namespace PHPMaker2022\growit_2021;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class UsersEdit extends Users
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'users';

    // Page object name
    public $PageObjName = "UsersEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (users)
        if (!isset($GLOBALS["users"]) || get_class($GLOBALS["users"]) == PROJECT_NAMESPACE . "users") {
            $GLOBALS["users"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'users');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("users");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "usersview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->auth_id->setVisibility();
        $this->avatar->setVisibility();
        $this->_username->setVisibility();
        $this->fullname->setVisibility();
        $this->_password->setVisibility();
        $this->role_id->setVisibility();
        $this->_token->setVisibility();
        $this->_email->setVisibility();
        $this->gender->setVisibility();
        $this->date_of_birth->setVisibility();
        $this->biography->setVisibility();
        $this->last_login->setVisibility();
        $this->is_verified->setVisibility();
        $this->location->setVisibility();
        $this->created_at->setVisibility();
        $this->updated_at->setVisibility();
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->is_verified);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("userslist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "userslist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id->Visible = false; // Disable update for API request
            } else {
                $this->id->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_id")) {
            $this->id->setOldValue($CurrentForm->getValue("o_id"));
        }

        // Check field name 'auth_id' first before field var 'x_auth_id'
        $val = $CurrentForm->hasValue("auth_id") ? $CurrentForm->getValue("auth_id") : $CurrentForm->getValue("x_auth_id");
        if (!$this->auth_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->auth_id->Visible = false; // Disable update for API request
            } else {
                $this->auth_id->setFormValue($val);
            }
        }

        // Check field name 'avatar' first before field var 'x_avatar'
        $val = $CurrentForm->hasValue("avatar") ? $CurrentForm->getValue("avatar") : $CurrentForm->getValue("x_avatar");
        if (!$this->avatar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->avatar->Visible = false; // Disable update for API request
            } else {
                $this->avatar->setFormValue($val);
            }
        }

        // Check field name 'username' first before field var 'x__username'
        $val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x__username");
        if (!$this->_username->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_username->Visible = false; // Disable update for API request
            } else {
                $this->_username->setFormValue($val);
            }
        }

        // Check field name 'fullname' first before field var 'x_fullname'
        $val = $CurrentForm->hasValue("fullname") ? $CurrentForm->getValue("fullname") : $CurrentForm->getValue("x_fullname");
        if (!$this->fullname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fullname->Visible = false; // Disable update for API request
            } else {
                $this->fullname->setFormValue($val);
            }
        }

        // Check field name 'password' first before field var 'x__password'
        $val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x__password");
        if (!$this->_password->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_password->Visible = false; // Disable update for API request
            } else {
                $this->_password->setFormValue($val);
            }
        }

        // Check field name 'role_id' first before field var 'x_role_id'
        $val = $CurrentForm->hasValue("role_id") ? $CurrentForm->getValue("role_id") : $CurrentForm->getValue("x_role_id");
        if (!$this->role_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->role_id->Visible = false; // Disable update for API request
            } else {
                $this->role_id->setFormValue($val);
            }
        }

        // Check field name 'token' first before field var 'x__token'
        $val = $CurrentForm->hasValue("token") ? $CurrentForm->getValue("token") : $CurrentForm->getValue("x__token");
        if (!$this->_token->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_token->Visible = false; // Disable update for API request
            } else {
                $this->_token->setFormValue($val);
            }
        }

        // Check field name 'email' first before field var 'x__email'
        $val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
        if (!$this->_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_email->Visible = false; // Disable update for API request
            } else {
                $this->_email->setFormValue($val);
            }
        }

        // Check field name 'gender' first before field var 'x_gender'
        $val = $CurrentForm->hasValue("gender") ? $CurrentForm->getValue("gender") : $CurrentForm->getValue("x_gender");
        if (!$this->gender->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gender->Visible = false; // Disable update for API request
            } else {
                $this->gender->setFormValue($val);
            }
        }

        // Check field name 'date_of_birth' first before field var 'x_date_of_birth'
        $val = $CurrentForm->hasValue("date_of_birth") ? $CurrentForm->getValue("date_of_birth") : $CurrentForm->getValue("x_date_of_birth");
        if (!$this->date_of_birth->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_of_birth->Visible = false; // Disable update for API request
            } else {
                $this->date_of_birth->setFormValue($val, true, $validate);
            }
            $this->date_of_birth->CurrentValue = UnFormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        }

        // Check field name 'biography' first before field var 'x_biography'
        $val = $CurrentForm->hasValue("biography") ? $CurrentForm->getValue("biography") : $CurrentForm->getValue("x_biography");
        if (!$this->biography->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->biography->Visible = false; // Disable update for API request
            } else {
                $this->biography->setFormValue($val);
            }
        }

        // Check field name 'last_login' first before field var 'x_last_login'
        $val = $CurrentForm->hasValue("last_login") ? $CurrentForm->getValue("last_login") : $CurrentForm->getValue("x_last_login");
        if (!$this->last_login->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->last_login->Visible = false; // Disable update for API request
            } else {
                $this->last_login->setFormValue($val, true, $validate);
            }
            $this->last_login->CurrentValue = UnFormatDateTime($this->last_login->CurrentValue, $this->last_login->formatPattern());
        }

        // Check field name 'is_verified' first before field var 'x_is_verified'
        $val = $CurrentForm->hasValue("is_verified") ? $CurrentForm->getValue("is_verified") : $CurrentForm->getValue("x_is_verified");
        if (!$this->is_verified->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->is_verified->Visible = false; // Disable update for API request
            } else {
                $this->is_verified->setFormValue($val);
            }
        }

        // Check field name 'location' first before field var 'x_location'
        $val = $CurrentForm->hasValue("location") ? $CurrentForm->getValue("location") : $CurrentForm->getValue("x_location");
        if (!$this->location->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->location->Visible = false; // Disable update for API request
            } else {
                $this->location->setFormValue($val);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val, true, $validate);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val, true, $validate);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->auth_id->CurrentValue = $this->auth_id->FormValue;
        $this->avatar->CurrentValue = $this->avatar->FormValue;
        $this->_username->CurrentValue = $this->_username->FormValue;
        $this->fullname->CurrentValue = $this->fullname->FormValue;
        $this->_password->CurrentValue = $this->_password->FormValue;
        $this->role_id->CurrentValue = $this->role_id->FormValue;
        $this->_token->CurrentValue = $this->_token->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->gender->CurrentValue = $this->gender->FormValue;
        $this->date_of_birth->CurrentValue = $this->date_of_birth->FormValue;
        $this->date_of_birth->CurrentValue = UnFormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        $this->biography->CurrentValue = $this->biography->FormValue;
        $this->last_login->CurrentValue = $this->last_login->FormValue;
        $this->last_login->CurrentValue = UnFormatDateTime($this->last_login->CurrentValue, $this->last_login->formatPattern());
        $this->is_verified->CurrentValue = $this->is_verified->FormValue;
        $this->location->CurrentValue = $this->location->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->updated_at->CurrentValue = $this->updated_at->FormValue;
        $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->auth_id->setDbValue($row['auth_id']);
        $this->avatar->setDbValue($row['avatar']);
        $this->_username->setDbValue($row['username']);
        $this->fullname->setDbValue($row['fullname']);
        $this->_password->setDbValue($row['password']);
        $this->role_id->setDbValue($row['role_id']);
        $this->_token->setDbValue($row['token']);
        $this->_email->setDbValue($row['email']);
        $this->gender->setDbValue($row['gender']);
        $this->date_of_birth->setDbValue($row['date_of_birth']);
        $this->biography->setDbValue($row['biography']);
        $this->last_login->setDbValue($row['last_login']);
        $this->is_verified->setDbValue((ConvertToBool($row['is_verified']) ? "1" : "0"));
        $this->location->setDbValue($row['location']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['auth_id'] = $this->auth_id->DefaultValue;
        $row['avatar'] = $this->avatar->DefaultValue;
        $row['username'] = $this->_username->DefaultValue;
        $row['fullname'] = $this->fullname->DefaultValue;
        $row['password'] = $this->_password->DefaultValue;
        $row['role_id'] = $this->role_id->DefaultValue;
        $row['token'] = $this->_token->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['gender'] = $this->gender->DefaultValue;
        $row['date_of_birth'] = $this->date_of_birth->DefaultValue;
        $row['biography'] = $this->biography->DefaultValue;
        $row['last_login'] = $this->last_login->DefaultValue;
        $row['is_verified'] = $this->is_verified->DefaultValue;
        $row['location'] = $this->location->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
        $row['updated_at'] = $this->updated_at->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // auth_id
        $this->auth_id->RowCssClass = "row";

        // avatar
        $this->avatar->RowCssClass = "row";

        // username
        $this->_username->RowCssClass = "row";

        // fullname
        $this->fullname->RowCssClass = "row";

        // password
        $this->_password->RowCssClass = "row";

        // role_id
        $this->role_id->RowCssClass = "row";

        // token
        $this->_token->RowCssClass = "row";

        // email
        $this->_email->RowCssClass = "row";

        // gender
        $this->gender->RowCssClass = "row";

        // date_of_birth
        $this->date_of_birth->RowCssClass = "row";

        // biography
        $this->biography->RowCssClass = "row";

        // last_login
        $this->last_login->RowCssClass = "row";

        // is_verified
        $this->is_verified->RowCssClass = "row";

        // location
        $this->location->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // auth_id
            $this->auth_id->ViewValue = $this->auth_id->CurrentValue;
            $this->auth_id->ViewCustomAttributes = "";

            // avatar
            $this->avatar->ViewValue = $this->avatar->CurrentValue;
            $this->avatar->ViewCustomAttributes = "";

            // username
            $this->_username->ViewValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";

            // fullname
            $this->fullname->ViewValue = $this->fullname->CurrentValue;
            $this->fullname->ViewCustomAttributes = "";

            // password
            $this->_password->ViewValue = $this->_password->CurrentValue;
            $this->_password->ViewCustomAttributes = "";

            // role_id
            $this->role_id->ViewValue = $this->role_id->CurrentValue;
            $this->role_id->ViewCustomAttributes = "";

            // token
            $this->_token->ViewValue = $this->_token->CurrentValue;
            $this->_token->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // gender
            $this->gender->ViewValue = $this->gender->CurrentValue;
            $this->gender->ViewCustomAttributes = "";

            // date_of_birth
            $this->date_of_birth->ViewValue = $this->date_of_birth->CurrentValue;
            $this->date_of_birth->ViewValue = FormatDateTime($this->date_of_birth->ViewValue, $this->date_of_birth->formatPattern());
            $this->date_of_birth->ViewCustomAttributes = "";

            // biography
            $this->biography->ViewValue = $this->biography->CurrentValue;
            $this->biography->ViewCustomAttributes = "";

            // last_login
            $this->last_login->ViewValue = $this->last_login->CurrentValue;
            $this->last_login->ViewValue = FormatDateTime($this->last_login->ViewValue, $this->last_login->formatPattern());
            $this->last_login->ViewCustomAttributes = "";

            // is_verified
            if (ConvertToBool($this->is_verified->CurrentValue)) {
                $this->is_verified->ViewValue = $this->is_verified->tagCaption(1) != "" ? $this->is_verified->tagCaption(1) : "Yes";
            } else {
                $this->is_verified->ViewValue = $this->is_verified->tagCaption(2) != "" ? $this->is_verified->tagCaption(2) : "No";
            }
            $this->is_verified->ViewCustomAttributes = "";

            // location
            $this->location->ViewValue = $this->location->CurrentValue;
            $this->location->ViewCustomAttributes = "";

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());
            $this->created_at->ViewCustomAttributes = "";

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());
            $this->updated_at->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // auth_id
            $this->auth_id->LinkCustomAttributes = "";
            $this->auth_id->HrefValue = "";

            // avatar
            $this->avatar->LinkCustomAttributes = "";
            $this->avatar->HrefValue = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";

            // fullname
            $this->fullname->LinkCustomAttributes = "";
            $this->fullname->HrefValue = "";

            // password
            $this->_password->LinkCustomAttributes = "";
            $this->_password->HrefValue = "";

            // role_id
            $this->role_id->LinkCustomAttributes = "";
            $this->role_id->HrefValue = "";

            // token
            $this->_token->LinkCustomAttributes = "";
            $this->_token->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // gender
            $this->gender->LinkCustomAttributes = "";
            $this->gender->HrefValue = "";

            // date_of_birth
            $this->date_of_birth->LinkCustomAttributes = "";
            $this->date_of_birth->HrefValue = "";

            // biography
            $this->biography->LinkCustomAttributes = "";
            $this->biography->HrefValue = "";

            // last_login
            $this->last_login->LinkCustomAttributes = "";
            $this->last_login->HrefValue = "";

            // is_verified
            $this->is_verified->LinkCustomAttributes = "";
            $this->is_verified->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->CurrentValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());

            // auth_id
            $this->auth_id->setupEditAttributes();
            $this->auth_id->EditCustomAttributes = "";
            if (!$this->auth_id->Raw) {
                $this->auth_id->CurrentValue = HtmlDecode($this->auth_id->CurrentValue);
            }
            $this->auth_id->EditValue = HtmlEncode($this->auth_id->CurrentValue);
            $this->auth_id->PlaceHolder = RemoveHtml($this->auth_id->caption());

            // avatar
            $this->avatar->setupEditAttributes();
            $this->avatar->EditCustomAttributes = "";
            if (!$this->avatar->Raw) {
                $this->avatar->CurrentValue = HtmlDecode($this->avatar->CurrentValue);
            }
            $this->avatar->EditValue = HtmlEncode($this->avatar->CurrentValue);
            $this->avatar->PlaceHolder = RemoveHtml($this->avatar->caption());

            // username
            $this->_username->setupEditAttributes();
            $this->_username->EditCustomAttributes = "";
            if (!$this->_username->Raw) {
                $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
            }
            $this->_username->EditValue = HtmlEncode($this->_username->CurrentValue);
            $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

            // fullname
            $this->fullname->setupEditAttributes();
            $this->fullname->EditCustomAttributes = "";
            if (!$this->fullname->Raw) {
                $this->fullname->CurrentValue = HtmlDecode($this->fullname->CurrentValue);
            }
            $this->fullname->EditValue = HtmlEncode($this->fullname->CurrentValue);
            $this->fullname->PlaceHolder = RemoveHtml($this->fullname->caption());

            // password
            $this->_password->setupEditAttributes();
            $this->_password->EditCustomAttributes = "";
            if (!$this->_password->Raw) {
                $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
            }
            $this->_password->EditValue = HtmlEncode($this->_password->CurrentValue);
            $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

            // role_id
            $this->role_id->setupEditAttributes();
            $this->role_id->EditCustomAttributes = "";
            if (!$this->role_id->Raw) {
                $this->role_id->CurrentValue = HtmlDecode($this->role_id->CurrentValue);
            }
            $this->role_id->EditValue = HtmlEncode($this->role_id->CurrentValue);
            $this->role_id->PlaceHolder = RemoveHtml($this->role_id->caption());

            // token
            $this->_token->setupEditAttributes();
            $this->_token->EditCustomAttributes = "";
            if (!$this->_token->Raw) {
                $this->_token->CurrentValue = HtmlDecode($this->_token->CurrentValue);
            }
            $this->_token->EditValue = HtmlEncode($this->_token->CurrentValue);
            $this->_token->PlaceHolder = RemoveHtml($this->_token->caption());

            // email
            $this->_email->setupEditAttributes();
            $this->_email->EditCustomAttributes = "";
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

            // gender
            $this->gender->setupEditAttributes();
            $this->gender->EditCustomAttributes = "";
            if (!$this->gender->Raw) {
                $this->gender->CurrentValue = HtmlDecode($this->gender->CurrentValue);
            }
            $this->gender->EditValue = HtmlEncode($this->gender->CurrentValue);
            $this->gender->PlaceHolder = RemoveHtml($this->gender->caption());

            // date_of_birth
            $this->date_of_birth->setupEditAttributes();
            $this->date_of_birth->EditCustomAttributes = "";
            $this->date_of_birth->EditValue = HtmlEncode(FormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern()));
            $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

            // biography
            $this->biography->setupEditAttributes();
            $this->biography->EditCustomAttributes = "";
            $this->biography->EditValue = HtmlEncode($this->biography->CurrentValue);
            $this->biography->PlaceHolder = RemoveHtml($this->biography->caption());

            // last_login
            $this->last_login->setupEditAttributes();
            $this->last_login->EditCustomAttributes = "";
            $this->last_login->EditValue = HtmlEncode(FormatDateTime($this->last_login->CurrentValue, $this->last_login->formatPattern()));
            $this->last_login->PlaceHolder = RemoveHtml($this->last_login->caption());

            // is_verified
            $this->is_verified->EditCustomAttributes = "";
            $this->is_verified->EditValue = $this->is_verified->options(false);
            $this->is_verified->PlaceHolder = RemoveHtml($this->is_verified->caption());

            // location
            $this->location->setupEditAttributes();
            $this->location->EditCustomAttributes = "";
            if (!$this->location->Raw) {
                $this->location->CurrentValue = HtmlDecode($this->location->CurrentValue);
            }
            $this->location->EditValue = HtmlEncode($this->location->CurrentValue);
            $this->location->PlaceHolder = RemoveHtml($this->location->caption());

            // created_at
            $this->created_at->setupEditAttributes();
            $this->created_at->EditCustomAttributes = "";
            $this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()));
            $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

            // updated_at
            $this->updated_at->setupEditAttributes();
            $this->updated_at->EditCustomAttributes = "";
            $this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()));
            $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // auth_id
            $this->auth_id->LinkCustomAttributes = "";
            $this->auth_id->HrefValue = "";

            // avatar
            $this->avatar->LinkCustomAttributes = "";
            $this->avatar->HrefValue = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";

            // fullname
            $this->fullname->LinkCustomAttributes = "";
            $this->fullname->HrefValue = "";

            // password
            $this->_password->LinkCustomAttributes = "";
            $this->_password->HrefValue = "";

            // role_id
            $this->role_id->LinkCustomAttributes = "";
            $this->role_id->HrefValue = "";

            // token
            $this->_token->LinkCustomAttributes = "";
            $this->_token->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // gender
            $this->gender->LinkCustomAttributes = "";
            $this->gender->HrefValue = "";

            // date_of_birth
            $this->date_of_birth->LinkCustomAttributes = "";
            $this->date_of_birth->HrefValue = "";

            // biography
            $this->biography->LinkCustomAttributes = "";
            $this->biography->HrefValue = "";

            // last_login
            $this->last_login->LinkCustomAttributes = "";
            $this->last_login->HrefValue = "";

            // is_verified
            $this->is_verified->LinkCustomAttributes = "";
            $this->is_verified->HrefValue = "";

            // location
            $this->location->LinkCustomAttributes = "";
            $this->location->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
        if (!CheckGuid($this->id->FormValue)) {
            $this->id->addErrorMessage($this->id->getErrorMessage(false));
        }
        if ($this->auth_id->Required) {
            if (!$this->auth_id->IsDetailKey && EmptyValue($this->auth_id->FormValue)) {
                $this->auth_id->addErrorMessage(str_replace("%s", $this->auth_id->caption(), $this->auth_id->RequiredErrorMessage));
            }
        }
        if ($this->avatar->Required) {
            if (!$this->avatar->IsDetailKey && EmptyValue($this->avatar->FormValue)) {
                $this->avatar->addErrorMessage(str_replace("%s", $this->avatar->caption(), $this->avatar->RequiredErrorMessage));
            }
        }
        if ($this->_username->Required) {
            if (!$this->_username->IsDetailKey && EmptyValue($this->_username->FormValue)) {
                $this->_username->addErrorMessage(str_replace("%s", $this->_username->caption(), $this->_username->RequiredErrorMessage));
            }
        }
        if ($this->fullname->Required) {
            if (!$this->fullname->IsDetailKey && EmptyValue($this->fullname->FormValue)) {
                $this->fullname->addErrorMessage(str_replace("%s", $this->fullname->caption(), $this->fullname->RequiredErrorMessage));
            }
        }
        if ($this->_password->Required) {
            if (!$this->_password->IsDetailKey && EmptyValue($this->_password->FormValue)) {
                $this->_password->addErrorMessage(str_replace("%s", $this->_password->caption(), $this->_password->RequiredErrorMessage));
            }
        }
        if ($this->role_id->Required) {
            if (!$this->role_id->IsDetailKey && EmptyValue($this->role_id->FormValue)) {
                $this->role_id->addErrorMessage(str_replace("%s", $this->role_id->caption(), $this->role_id->RequiredErrorMessage));
            }
        }
        if ($this->_token->Required) {
            if (!$this->_token->IsDetailKey && EmptyValue($this->_token->FormValue)) {
                $this->_token->addErrorMessage(str_replace("%s", $this->_token->caption(), $this->_token->RequiredErrorMessage));
            }
        }
        if ($this->_email->Required) {
            if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
            }
        }
        if ($this->gender->Required) {
            if (!$this->gender->IsDetailKey && EmptyValue($this->gender->FormValue)) {
                $this->gender->addErrorMessage(str_replace("%s", $this->gender->caption(), $this->gender->RequiredErrorMessage));
            }
        }
        if ($this->date_of_birth->Required) {
            if (!$this->date_of_birth->IsDetailKey && EmptyValue($this->date_of_birth->FormValue)) {
                $this->date_of_birth->addErrorMessage(str_replace("%s", $this->date_of_birth->caption(), $this->date_of_birth->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_of_birth->FormValue, $this->date_of_birth->formatPattern())) {
            $this->date_of_birth->addErrorMessage($this->date_of_birth->getErrorMessage(false));
        }
        if ($this->biography->Required) {
            if (!$this->biography->IsDetailKey && EmptyValue($this->biography->FormValue)) {
                $this->biography->addErrorMessage(str_replace("%s", $this->biography->caption(), $this->biography->RequiredErrorMessage));
            }
        }
        if ($this->last_login->Required) {
            if (!$this->last_login->IsDetailKey && EmptyValue($this->last_login->FormValue)) {
                $this->last_login->addErrorMessage(str_replace("%s", $this->last_login->caption(), $this->last_login->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->last_login->FormValue, $this->last_login->formatPattern())) {
            $this->last_login->addErrorMessage($this->last_login->getErrorMessage(false));
        }
        if ($this->is_verified->Required) {
            if ($this->is_verified->FormValue == "") {
                $this->is_verified->addErrorMessage(str_replace("%s", $this->is_verified->caption(), $this->is_verified->RequiredErrorMessage));
            }
        }
        if ($this->location->Required) {
            if (!$this->location->IsDetailKey && EmptyValue($this->location->FormValue)) {
                $this->location->addErrorMessage(str_replace("%s", $this->location->caption(), $this->location->RequiredErrorMessage));
            }
        }
        if ($this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->created_at->FormValue, $this->created_at->formatPattern())) {
            $this->created_at->addErrorMessage($this->created_at->getErrorMessage(false));
        }
        if ($this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->updated_at->FormValue, $this->updated_at->formatPattern())) {
            $this->updated_at->addErrorMessage($this->updated_at->getErrorMessage(false));
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // id
        $this->id->setDbValueDef($rsnew, $this->id->CurrentValue, "{00000000-0000-0000-0000-000000000000}", $this->id->ReadOnly);

        // auth_id
        $this->auth_id->setDbValueDef($rsnew, $this->auth_id->CurrentValue, null, $this->auth_id->ReadOnly);

        // avatar
        $this->avatar->setDbValueDef($rsnew, $this->avatar->CurrentValue, null, $this->avatar->ReadOnly);

        // username
        $this->_username->setDbValueDef($rsnew, $this->_username->CurrentValue, null, $this->_username->ReadOnly);

        // fullname
        $this->fullname->setDbValueDef($rsnew, $this->fullname->CurrentValue, null, $this->fullname->ReadOnly);

        // password
        $this->_password->setDbValueDef($rsnew, $this->_password->CurrentValue, null, $this->_password->ReadOnly);

        // role_id
        $this->role_id->setDbValueDef($rsnew, $this->role_id->CurrentValue, "", $this->role_id->ReadOnly);

        // token
        $this->_token->setDbValueDef($rsnew, $this->_token->CurrentValue, null, $this->_token->ReadOnly);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, null, $this->_email->ReadOnly);

        // gender
        $this->gender->setDbValueDef($rsnew, $this->gender->CurrentValue, null, $this->gender->ReadOnly);

        // date_of_birth
        $this->date_of_birth->setDbValueDef($rsnew, UnFormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern()), null, $this->date_of_birth->ReadOnly);

        // biography
        $this->biography->setDbValueDef($rsnew, $this->biography->CurrentValue, null, $this->biography->ReadOnly);

        // last_login
        $this->last_login->setDbValueDef($rsnew, UnFormatDateTime($this->last_login->CurrentValue, $this->last_login->formatPattern()), null, $this->last_login->ReadOnly);

        // is_verified
        $tmpBool = $this->is_verified->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->is_verified->setDbValueDef($rsnew, $tmpBool, null, $this->is_verified->ReadOnly);

        // location
        $this->location->setDbValueDef($rsnew, $this->location->CurrentValue, null, $this->location->ReadOnly);

        // created_at
        $this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()), CurrentDate(), $this->created_at->ReadOnly);

        // updated_at
        $this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()), CurrentDate(), $this->updated_at->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check field with unique index (id)
        if ($this->id->CurrentValue != "") {
            $filterChk = "(\"id\" = '" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->id->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->id->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

        // Check field with unique index (username)
        if ($this->_username->CurrentValue != "") {
            $filterChk = "(\"username\" = '" . AdjustSql($this->_username->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->_username->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->_username->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);

        // Check for duplicate key when key changed
        if ($updateRow) {
            $newKeyFilter = $this->getRecordFilter($rsnew);
            if ($newKeyFilter != $oldKeyFilter) {
                $rsChk = $this->loadRs($newKeyFilter)->fetch();
                if ($rsChk !== false) {
                    $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                    $this->setFailureMessage($keyErrMsg);
                    $updateRow = false;
                }
            }
        }
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("userslist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_is_verified":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            if ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
