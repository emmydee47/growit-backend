<?php

namespace PHPMaker2022\growit_2021;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class JobsEdit extends Jobs
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'jobs';

    // Page object name
    public $PageObjName = "JobsEdit";

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

        // Table object (jobs)
        if (!isset($GLOBALS["jobs"]) || get_class($GLOBALS["jobs"]) == PROJECT_NAMESPACE . "jobs") {
            $GLOBALS["jobs"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'jobs');
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
                $tbl = Container("jobs");
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
                    if ($pageName == "jobsview") {
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
        $this->user_id->setVisibility();
        $this->crop_id->setVisibility();
        $this->variety->setVisibility();
        $this->crop_type->setVisibility();
        $this->job_type->setVisibility();
        $this->assigned_by->setVisibility();
        $this->_title->setVisibility();
        $this->job_date->setVisibility();
        $this->status->setVisibility();
        $this->stage_one_completed->setVisibility();
        $this->stage_two_completed->setVisibility();
        $this->stage_three_completed->setVisibility();
        $this->sow_date->setVisibility();
        $this->plant_date->setVisibility();
        $this->harvest_start_date->setVisibility();
        $this->harvest_end_date->setVisibility();
        $this->updated_at->setVisibility();
        $this->created_at->setVisibility();
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
        $this->setupLookupOptions($this->user_id);
        $this->setupLookupOptions($this->crop_id);
        $this->setupLookupOptions($this->job_type);
        $this->setupLookupOptions($this->status);
        $this->setupLookupOptions($this->stage_one_completed);
        $this->setupLookupOptions($this->stage_two_completed);
        $this->setupLookupOptions($this->stage_three_completed);

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
                        $this->terminate("jobslist"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "jobslist") {
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

        // Check field name 'user_id' first before field var 'x_user_id'
        $val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
        if (!$this->user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user_id->Visible = false; // Disable update for API request
            } else {
                $this->user_id->setFormValue($val);
            }
        }

        // Check field name 'crop_id' first before field var 'x_crop_id'
        $val = $CurrentForm->hasValue("crop_id") ? $CurrentForm->getValue("crop_id") : $CurrentForm->getValue("x_crop_id");
        if (!$this->crop_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->crop_id->Visible = false; // Disable update for API request
            } else {
                $this->crop_id->setFormValue($val);
            }
        }

        // Check field name 'variety' first before field var 'x_variety'
        $val = $CurrentForm->hasValue("variety") ? $CurrentForm->getValue("variety") : $CurrentForm->getValue("x_variety");
        if (!$this->variety->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->variety->Visible = false; // Disable update for API request
            } else {
                $this->variety->setFormValue($val);
            }
        }

        // Check field name 'crop_type' first before field var 'x_crop_type'
        $val = $CurrentForm->hasValue("crop_type") ? $CurrentForm->getValue("crop_type") : $CurrentForm->getValue("x_crop_type");
        if (!$this->crop_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->crop_type->Visible = false; // Disable update for API request
            } else {
                $this->crop_type->setFormValue($val);
            }
        }

        // Check field name 'job_type' first before field var 'x_job_type'
        $val = $CurrentForm->hasValue("job_type") ? $CurrentForm->getValue("job_type") : $CurrentForm->getValue("x_job_type");
        if (!$this->job_type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->job_type->Visible = false; // Disable update for API request
            } else {
                $this->job_type->setFormValue($val);
            }
        }

        // Check field name 'assigned_by' first before field var 'x_assigned_by'
        $val = $CurrentForm->hasValue("assigned_by") ? $CurrentForm->getValue("assigned_by") : $CurrentForm->getValue("x_assigned_by");
        if (!$this->assigned_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->assigned_by->Visible = false; // Disable update for API request
            } else {
                $this->assigned_by->setFormValue($val);
            }
        }

        // Check field name 'title' first before field var 'x__title'
        $val = $CurrentForm->hasValue("title") ? $CurrentForm->getValue("title") : $CurrentForm->getValue("x__title");
        if (!$this->_title->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_title->Visible = false; // Disable update for API request
            } else {
                $this->_title->setFormValue($val);
            }
        }

        // Check field name 'job_date' first before field var 'x_job_date'
        $val = $CurrentForm->hasValue("job_date") ? $CurrentForm->getValue("job_date") : $CurrentForm->getValue("x_job_date");
        if (!$this->job_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->job_date->Visible = false; // Disable update for API request
            } else {
                $this->job_date->setFormValue($val, true, $validate);
            }
            $this->job_date->CurrentValue = UnFormatDateTime($this->job_date->CurrentValue, $this->job_date->formatPattern());
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'stage_one_completed' first before field var 'x_stage_one_completed'
        $val = $CurrentForm->hasValue("stage_one_completed") ? $CurrentForm->getValue("stage_one_completed") : $CurrentForm->getValue("x_stage_one_completed");
        if (!$this->stage_one_completed->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stage_one_completed->Visible = false; // Disable update for API request
            } else {
                $this->stage_one_completed->setFormValue($val);
            }
        }

        // Check field name 'stage_two_completed' first before field var 'x_stage_two_completed'
        $val = $CurrentForm->hasValue("stage_two_completed") ? $CurrentForm->getValue("stage_two_completed") : $CurrentForm->getValue("x_stage_two_completed");
        if (!$this->stage_two_completed->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stage_two_completed->Visible = false; // Disable update for API request
            } else {
                $this->stage_two_completed->setFormValue($val);
            }
        }

        // Check field name 'stage_three_completed' first before field var 'x_stage_three_completed'
        $val = $CurrentForm->hasValue("stage_three_completed") ? $CurrentForm->getValue("stage_three_completed") : $CurrentForm->getValue("x_stage_three_completed");
        if (!$this->stage_three_completed->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stage_three_completed->Visible = false; // Disable update for API request
            } else {
                $this->stage_three_completed->setFormValue($val);
            }
        }

        // Check field name 'sow_date' first before field var 'x_sow_date'
        $val = $CurrentForm->hasValue("sow_date") ? $CurrentForm->getValue("sow_date") : $CurrentForm->getValue("x_sow_date");
        if (!$this->sow_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sow_date->Visible = false; // Disable update for API request
            } else {
                $this->sow_date->setFormValue($val, true, $validate);
            }
            $this->sow_date->CurrentValue = UnFormatDateTime($this->sow_date->CurrentValue, $this->sow_date->formatPattern());
        }

        // Check field name 'plant_date' first before field var 'x_plant_date'
        $val = $CurrentForm->hasValue("plant_date") ? $CurrentForm->getValue("plant_date") : $CurrentForm->getValue("x_plant_date");
        if (!$this->plant_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->plant_date->Visible = false; // Disable update for API request
            } else {
                $this->plant_date->setFormValue($val, true, $validate);
            }
            $this->plant_date->CurrentValue = UnFormatDateTime($this->plant_date->CurrentValue, $this->plant_date->formatPattern());
        }

        // Check field name 'harvest_start_date' first before field var 'x_harvest_start_date'
        $val = $CurrentForm->hasValue("harvest_start_date") ? $CurrentForm->getValue("harvest_start_date") : $CurrentForm->getValue("x_harvest_start_date");
        if (!$this->harvest_start_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->harvest_start_date->Visible = false; // Disable update for API request
            } else {
                $this->harvest_start_date->setFormValue($val, true, $validate);
            }
            $this->harvest_start_date->CurrentValue = UnFormatDateTime($this->harvest_start_date->CurrentValue, $this->harvest_start_date->formatPattern());
        }

        // Check field name 'harvest_end_date' first before field var 'x_harvest_end_date'
        $val = $CurrentForm->hasValue("harvest_end_date") ? $CurrentForm->getValue("harvest_end_date") : $CurrentForm->getValue("x_harvest_end_date");
        if (!$this->harvest_end_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->harvest_end_date->Visible = false; // Disable update for API request
            } else {
                $this->harvest_end_date->setFormValue($val, true, $validate);
            }
            $this->harvest_end_date->CurrentValue = UnFormatDateTime($this->harvest_end_date->CurrentValue, $this->harvest_end_date->formatPattern());
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->user_id->CurrentValue = $this->user_id->FormValue;
        $this->crop_id->CurrentValue = $this->crop_id->FormValue;
        $this->variety->CurrentValue = $this->variety->FormValue;
        $this->crop_type->CurrentValue = $this->crop_type->FormValue;
        $this->job_type->CurrentValue = $this->job_type->FormValue;
        $this->assigned_by->CurrentValue = $this->assigned_by->FormValue;
        $this->_title->CurrentValue = $this->_title->FormValue;
        $this->job_date->CurrentValue = $this->job_date->FormValue;
        $this->job_date->CurrentValue = UnFormatDateTime($this->job_date->CurrentValue, $this->job_date->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
        $this->stage_one_completed->CurrentValue = $this->stage_one_completed->FormValue;
        $this->stage_two_completed->CurrentValue = $this->stage_two_completed->FormValue;
        $this->stage_three_completed->CurrentValue = $this->stage_three_completed->FormValue;
        $this->sow_date->CurrentValue = $this->sow_date->FormValue;
        $this->sow_date->CurrentValue = UnFormatDateTime($this->sow_date->CurrentValue, $this->sow_date->formatPattern());
        $this->plant_date->CurrentValue = $this->plant_date->FormValue;
        $this->plant_date->CurrentValue = UnFormatDateTime($this->plant_date->CurrentValue, $this->plant_date->formatPattern());
        $this->harvest_start_date->CurrentValue = $this->harvest_start_date->FormValue;
        $this->harvest_start_date->CurrentValue = UnFormatDateTime($this->harvest_start_date->CurrentValue, $this->harvest_start_date->formatPattern());
        $this->harvest_end_date->CurrentValue = $this->harvest_end_date->FormValue;
        $this->harvest_end_date->CurrentValue = UnFormatDateTime($this->harvest_end_date->CurrentValue, $this->harvest_end_date->formatPattern());
        $this->updated_at->CurrentValue = $this->updated_at->FormValue;
        $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
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
        $this->user_id->setDbValue($row['user_id']);
        $this->crop_id->setDbValue($row['crop_id']);
        $this->variety->setDbValue($row['variety']);
        $this->crop_type->setDbValue($row['crop_type']);
        $this->job_type->setDbValue($row['job_type']);
        $this->assigned_by->setDbValue($row['assigned_by']);
        $this->_title->setDbValue($row['title']);
        $this->job_date->setDbValue($row['job_date']);
        $this->status->setDbValue($row['status']);
        $this->stage_one_completed->setDbValue((ConvertToBool($row['stage_one_completed']) ? "1" : "0"));
        $this->stage_two_completed->setDbValue((ConvertToBool($row['stage_two_completed']) ? "1" : "0"));
        $this->stage_three_completed->setDbValue((ConvertToBool($row['stage_three_completed']) ? "1" : "0"));
        $this->sow_date->setDbValue($row['sow_date']);
        $this->plant_date->setDbValue($row['plant_date']);
        $this->harvest_start_date->setDbValue($row['harvest_start_date']);
        $this->harvest_end_date->setDbValue($row['harvest_end_date']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->created_at->setDbValue($row['created_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['user_id'] = $this->user_id->DefaultValue;
        $row['crop_id'] = $this->crop_id->DefaultValue;
        $row['variety'] = $this->variety->DefaultValue;
        $row['crop_type'] = $this->crop_type->DefaultValue;
        $row['job_type'] = $this->job_type->DefaultValue;
        $row['assigned_by'] = $this->assigned_by->DefaultValue;
        $row['title'] = $this->_title->DefaultValue;
        $row['job_date'] = $this->job_date->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['stage_one_completed'] = $this->stage_one_completed->DefaultValue;
        $row['stage_two_completed'] = $this->stage_two_completed->DefaultValue;
        $row['stage_three_completed'] = $this->stage_three_completed->DefaultValue;
        $row['sow_date'] = $this->sow_date->DefaultValue;
        $row['plant_date'] = $this->plant_date->DefaultValue;
        $row['harvest_start_date'] = $this->harvest_start_date->DefaultValue;
        $row['harvest_end_date'] = $this->harvest_end_date->DefaultValue;
        $row['updated_at'] = $this->updated_at->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
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

        // user_id
        $this->user_id->RowCssClass = "row";

        // crop_id
        $this->crop_id->RowCssClass = "row";

        // variety
        $this->variety->RowCssClass = "row";

        // crop_type
        $this->crop_type->RowCssClass = "row";

        // job_type
        $this->job_type->RowCssClass = "row";

        // assigned_by
        $this->assigned_by->RowCssClass = "row";

        // title
        $this->_title->RowCssClass = "row";

        // job_date
        $this->job_date->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // stage_one_completed
        $this->stage_one_completed->RowCssClass = "row";

        // stage_two_completed
        $this->stage_two_completed->RowCssClass = "row";

        // stage_three_completed
        $this->stage_three_completed->RowCssClass = "row";

        // sow_date
        $this->sow_date->RowCssClass = "row";

        // plant_date
        $this->plant_date->RowCssClass = "row";

        // harvest_start_date
        $this->harvest_start_date->RowCssClass = "row";

        // harvest_end_date
        $this->harvest_end_date->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // user_id
            $curVal = strval($this->user_id->CurrentValue);
            if ($curVal != "") {
                $this->user_id->ViewValue = $this->user_id->lookupCacheOption($curVal);
                if ($this->user_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_GUID, "");
                    $sqlWrk = $this->user_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->user_id->Lookup->renderViewRow($rswrk[0]);
                        $this->user_id->ViewValue = $this->user_id->displayValue($arwrk);
                    } else {
                        $this->user_id->ViewValue = $this->user_id->CurrentValue;
                    }
                }
            } else {
                $this->user_id->ViewValue = null;
            }
            $this->user_id->ViewCustomAttributes = "";

            // crop_id
            $curVal = strval($this->crop_id->CurrentValue);
            if ($curVal != "") {
                $this->crop_id->ViewValue = $this->crop_id->lookupCacheOption($curVal);
                if ($this->crop_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "\"id\"" . SearchString("=", $curVal, DATATYPE_GUID, "");
                    $sqlWrk = $this->crop_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->crop_id->Lookup->renderViewRow($rswrk[0]);
                        $this->crop_id->ViewValue = $this->crop_id->displayValue($arwrk);
                    } else {
                        $this->crop_id->ViewValue = $this->crop_id->CurrentValue;
                    }
                }
            } else {
                $this->crop_id->ViewValue = null;
            }
            $this->crop_id->ViewCustomAttributes = "";

            // variety
            $this->variety->ViewValue = $this->variety->CurrentValue;
            $this->variety->ViewCustomAttributes = "";

            // crop_type
            $this->crop_type->ViewValue = $this->crop_type->CurrentValue;
            $this->crop_type->ViewCustomAttributes = "";

            // job_type
            if (strval($this->job_type->CurrentValue) != "") {
                $this->job_type->ViewValue = $this->job_type->optionCaption($this->job_type->CurrentValue);
            } else {
                $this->job_type->ViewValue = null;
            }
            $this->job_type->ViewCustomAttributes = "";

            // assigned_by
            $this->assigned_by->ViewValue = $this->assigned_by->CurrentValue;
            $this->assigned_by->ViewCustomAttributes = "";

            // title
            $this->_title->ViewValue = $this->_title->CurrentValue;
            $this->_title->ViewCustomAttributes = "";

            // job_date
            $this->job_date->ViewValue = $this->job_date->CurrentValue;
            $this->job_date->ViewValue = FormatDateTime($this->job_date->ViewValue, $this->job_date->formatPattern());
            $this->job_date->ViewCustomAttributes = "";

            // status
            if (strval($this->status->CurrentValue) != "") {
                $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
            } else {
                $this->status->ViewValue = null;
            }
            $this->status->ViewCustomAttributes = "";

            // stage_one_completed
            if (ConvertToBool($this->stage_one_completed->CurrentValue)) {
                $this->stage_one_completed->ViewValue = $this->stage_one_completed->tagCaption(1) != "" ? $this->stage_one_completed->tagCaption(1) : "Yes";
            } else {
                $this->stage_one_completed->ViewValue = $this->stage_one_completed->tagCaption(2) != "" ? $this->stage_one_completed->tagCaption(2) : "No";
            }
            $this->stage_one_completed->ViewCustomAttributes = "";

            // stage_two_completed
            if (ConvertToBool($this->stage_two_completed->CurrentValue)) {
                $this->stage_two_completed->ViewValue = $this->stage_two_completed->tagCaption(1) != "" ? $this->stage_two_completed->tagCaption(1) : "Yes";
            } else {
                $this->stage_two_completed->ViewValue = $this->stage_two_completed->tagCaption(2) != "" ? $this->stage_two_completed->tagCaption(2) : "No";
            }
            $this->stage_two_completed->ViewCustomAttributes = "";

            // stage_three_completed
            if (ConvertToBool($this->stage_three_completed->CurrentValue)) {
                $this->stage_three_completed->ViewValue = $this->stage_three_completed->tagCaption(1) != "" ? $this->stage_three_completed->tagCaption(1) : "Yes";
            } else {
                $this->stage_three_completed->ViewValue = $this->stage_three_completed->tagCaption(2) != "" ? $this->stage_three_completed->tagCaption(2) : "No";
            }
            $this->stage_three_completed->ViewCustomAttributes = "";

            // sow_date
            $this->sow_date->ViewValue = $this->sow_date->CurrentValue;
            $this->sow_date->ViewValue = FormatDateTime($this->sow_date->ViewValue, $this->sow_date->formatPattern());
            $this->sow_date->ViewCustomAttributes = "";

            // plant_date
            $this->plant_date->ViewValue = $this->plant_date->CurrentValue;
            $this->plant_date->ViewValue = FormatDateTime($this->plant_date->ViewValue, $this->plant_date->formatPattern());
            $this->plant_date->ViewCustomAttributes = "";

            // harvest_start_date
            $this->harvest_start_date->ViewValue = $this->harvest_start_date->CurrentValue;
            $this->harvest_start_date->ViewValue = FormatDateTime($this->harvest_start_date->ViewValue, $this->harvest_start_date->formatPattern());
            $this->harvest_start_date->ViewCustomAttributes = "";

            // harvest_end_date
            $this->harvest_end_date->ViewValue = $this->harvest_end_date->CurrentValue;
            $this->harvest_end_date->ViewValue = FormatDateTime($this->harvest_end_date->ViewValue, $this->harvest_end_date->formatPattern());
            $this->harvest_end_date->ViewCustomAttributes = "";

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());
            $this->updated_at->ViewCustomAttributes = "";

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());
            $this->created_at->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // user_id
            $this->user_id->LinkCustomAttributes = "";
            $this->user_id->HrefValue = "";

            // crop_id
            $this->crop_id->LinkCustomAttributes = "";
            $this->crop_id->HrefValue = "";

            // variety
            $this->variety->LinkCustomAttributes = "";
            $this->variety->HrefValue = "";

            // crop_type
            $this->crop_type->LinkCustomAttributes = "";
            $this->crop_type->HrefValue = "";

            // job_type
            $this->job_type->LinkCustomAttributes = "";
            $this->job_type->HrefValue = "";

            // assigned_by
            $this->assigned_by->LinkCustomAttributes = "";
            $this->assigned_by->HrefValue = "";

            // title
            $this->_title->LinkCustomAttributes = "";
            $this->_title->HrefValue = "";

            // job_date
            $this->job_date->LinkCustomAttributes = "";
            $this->job_date->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // stage_one_completed
            $this->stage_one_completed->LinkCustomAttributes = "";
            $this->stage_one_completed->HrefValue = "";

            // stage_two_completed
            $this->stage_two_completed->LinkCustomAttributes = "";
            $this->stage_two_completed->HrefValue = "";

            // stage_three_completed
            $this->stage_three_completed->LinkCustomAttributes = "";
            $this->stage_three_completed->HrefValue = "";

            // sow_date
            $this->sow_date->LinkCustomAttributes = "";
            $this->sow_date->HrefValue = "";

            // plant_date
            $this->plant_date->LinkCustomAttributes = "";
            $this->plant_date->HrefValue = "";

            // harvest_start_date
            $this->harvest_start_date->LinkCustomAttributes = "";
            $this->harvest_start_date->HrefValue = "";

            // harvest_end_date
            $this->harvest_end_date->LinkCustomAttributes = "";
            $this->harvest_end_date->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->CurrentValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());

            // user_id
            $this->user_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->user_id->CurrentValue));
            if ($curVal != "") {
                $this->user_id->ViewValue = $this->user_id->lookupCacheOption($curVal);
            } else {
                $this->user_id->ViewValue = $this->user_id->Lookup !== null && is_array($this->user_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->user_id->ViewValue !== null) { // Load from cache
                $this->user_id->EditValue = array_values($this->user_id->lookupOptions());
                if ($this->user_id->ViewValue == "") {
                    $this->user_id->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "\"id\"" . SearchString("=", $this->user_id->CurrentValue, DATATYPE_GUID, "");
                }
                $sqlWrk = $this->user_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->user_id->Lookup->renderViewRow($rswrk[0]);
                    $this->user_id->ViewValue = $this->user_id->displayValue($arwrk);
                } else {
                    $this->user_id->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->user_id->EditValue = $arwrk;
            }
            $this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

            // crop_id
            $this->crop_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->crop_id->CurrentValue));
            if ($curVal != "") {
                $this->crop_id->ViewValue = $this->crop_id->lookupCacheOption($curVal);
            } else {
                $this->crop_id->ViewValue = $this->crop_id->Lookup !== null && is_array($this->crop_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->crop_id->ViewValue !== null) { // Load from cache
                $this->crop_id->EditValue = array_values($this->crop_id->lookupOptions());
                if ($this->crop_id->ViewValue == "") {
                    $this->crop_id->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "\"id\"" . SearchString("=", $this->crop_id->CurrentValue, DATATYPE_GUID, "");
                }
                $sqlWrk = $this->crop_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->crop_id->Lookup->renderViewRow($rswrk[0]);
                    $this->crop_id->ViewValue = $this->crop_id->displayValue($arwrk);
                } else {
                    $this->crop_id->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->crop_id->EditValue = $arwrk;
            }
            $this->crop_id->PlaceHolder = RemoveHtml($this->crop_id->caption());

            // variety
            $this->variety->setupEditAttributes();
            $this->variety->EditCustomAttributes = "";
            if (!$this->variety->Raw) {
                $this->variety->CurrentValue = HtmlDecode($this->variety->CurrentValue);
            }
            $this->variety->EditValue = HtmlEncode($this->variety->CurrentValue);
            $this->variety->PlaceHolder = RemoveHtml($this->variety->caption());

            // crop_type
            $this->crop_type->setupEditAttributes();
            $this->crop_type->EditCustomAttributes = "";
            if (!$this->crop_type->Raw) {
                $this->crop_type->CurrentValue = HtmlDecode($this->crop_type->CurrentValue);
            }
            $this->crop_type->EditValue = HtmlEncode($this->crop_type->CurrentValue);
            $this->crop_type->PlaceHolder = RemoveHtml($this->crop_type->caption());

            // job_type
            $this->job_type->setupEditAttributes();
            $this->job_type->EditCustomAttributes = "";
            $this->job_type->EditValue = $this->job_type->options(true);
            $this->job_type->PlaceHolder = RemoveHtml($this->job_type->caption());

            // assigned_by
            $this->assigned_by->setupEditAttributes();
            $this->assigned_by->EditCustomAttributes = "";
            if (!$this->assigned_by->Raw) {
                $this->assigned_by->CurrentValue = HtmlDecode($this->assigned_by->CurrentValue);
            }
            $this->assigned_by->EditValue = HtmlEncode($this->assigned_by->CurrentValue);
            $this->assigned_by->PlaceHolder = RemoveHtml($this->assigned_by->caption());

            // title
            $this->_title->setupEditAttributes();
            $this->_title->EditCustomAttributes = "";
            if (!$this->_title->Raw) {
                $this->_title->CurrentValue = HtmlDecode($this->_title->CurrentValue);
            }
            $this->_title->EditValue = HtmlEncode($this->_title->CurrentValue);
            $this->_title->PlaceHolder = RemoveHtml($this->_title->caption());

            // job_date
            $this->job_date->setupEditAttributes();
            $this->job_date->EditCustomAttributes = "";
            $this->job_date->EditValue = HtmlEncode(FormatDateTime($this->job_date->CurrentValue, $this->job_date->formatPattern()));
            $this->job_date->PlaceHolder = RemoveHtml($this->job_date->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            $this->status->EditValue = $this->status->options(true);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // stage_one_completed
            $this->stage_one_completed->EditCustomAttributes = "";
            $this->stage_one_completed->EditValue = $this->stage_one_completed->options(false);
            $this->stage_one_completed->PlaceHolder = RemoveHtml($this->stage_one_completed->caption());

            // stage_two_completed
            $this->stage_two_completed->EditCustomAttributes = "";
            $this->stage_two_completed->EditValue = $this->stage_two_completed->options(false);
            $this->stage_two_completed->PlaceHolder = RemoveHtml($this->stage_two_completed->caption());

            // stage_three_completed
            $this->stage_three_completed->EditCustomAttributes = "";
            $this->stage_three_completed->EditValue = $this->stage_three_completed->options(false);
            $this->stage_three_completed->PlaceHolder = RemoveHtml($this->stage_three_completed->caption());

            // sow_date
            $this->sow_date->setupEditAttributes();
            $this->sow_date->EditCustomAttributes = "";
            $this->sow_date->EditValue = HtmlEncode(FormatDateTime($this->sow_date->CurrentValue, $this->sow_date->formatPattern()));
            $this->sow_date->PlaceHolder = RemoveHtml($this->sow_date->caption());

            // plant_date
            $this->plant_date->setupEditAttributes();
            $this->plant_date->EditCustomAttributes = "";
            $this->plant_date->EditValue = HtmlEncode(FormatDateTime($this->plant_date->CurrentValue, $this->plant_date->formatPattern()));
            $this->plant_date->PlaceHolder = RemoveHtml($this->plant_date->caption());

            // harvest_start_date
            $this->harvest_start_date->setupEditAttributes();
            $this->harvest_start_date->EditCustomAttributes = "";
            $this->harvest_start_date->EditValue = HtmlEncode(FormatDateTime($this->harvest_start_date->CurrentValue, $this->harvest_start_date->formatPattern()));
            $this->harvest_start_date->PlaceHolder = RemoveHtml($this->harvest_start_date->caption());

            // harvest_end_date
            $this->harvest_end_date->setupEditAttributes();
            $this->harvest_end_date->EditCustomAttributes = "";
            $this->harvest_end_date->EditValue = HtmlEncode(FormatDateTime($this->harvest_end_date->CurrentValue, $this->harvest_end_date->formatPattern()));
            $this->harvest_end_date->PlaceHolder = RemoveHtml($this->harvest_end_date->caption());

            // updated_at
            $this->updated_at->setupEditAttributes();
            $this->updated_at->EditCustomAttributes = "";
            $this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()));
            $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

            // created_at
            $this->created_at->setupEditAttributes();
            $this->created_at->EditCustomAttributes = "";
            $this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()));
            $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // user_id
            $this->user_id->LinkCustomAttributes = "";
            $this->user_id->HrefValue = "";

            // crop_id
            $this->crop_id->LinkCustomAttributes = "";
            $this->crop_id->HrefValue = "";

            // variety
            $this->variety->LinkCustomAttributes = "";
            $this->variety->HrefValue = "";

            // crop_type
            $this->crop_type->LinkCustomAttributes = "";
            $this->crop_type->HrefValue = "";

            // job_type
            $this->job_type->LinkCustomAttributes = "";
            $this->job_type->HrefValue = "";

            // assigned_by
            $this->assigned_by->LinkCustomAttributes = "";
            $this->assigned_by->HrefValue = "";

            // title
            $this->_title->LinkCustomAttributes = "";
            $this->_title->HrefValue = "";

            // job_date
            $this->job_date->LinkCustomAttributes = "";
            $this->job_date->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // stage_one_completed
            $this->stage_one_completed->LinkCustomAttributes = "";
            $this->stage_one_completed->HrefValue = "";

            // stage_two_completed
            $this->stage_two_completed->LinkCustomAttributes = "";
            $this->stage_two_completed->HrefValue = "";

            // stage_three_completed
            $this->stage_three_completed->LinkCustomAttributes = "";
            $this->stage_three_completed->HrefValue = "";

            // sow_date
            $this->sow_date->LinkCustomAttributes = "";
            $this->sow_date->HrefValue = "";

            // plant_date
            $this->plant_date->LinkCustomAttributes = "";
            $this->plant_date->HrefValue = "";

            // harvest_start_date
            $this->harvest_start_date->LinkCustomAttributes = "";
            $this->harvest_start_date->HrefValue = "";

            // harvest_end_date
            $this->harvest_end_date->LinkCustomAttributes = "";
            $this->harvest_end_date->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";
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
        if ($this->user_id->Required) {
            if (!$this->user_id->IsDetailKey && EmptyValue($this->user_id->FormValue)) {
                $this->user_id->addErrorMessage(str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
            }
        }
        if ($this->crop_id->Required) {
            if (!$this->crop_id->IsDetailKey && EmptyValue($this->crop_id->FormValue)) {
                $this->crop_id->addErrorMessage(str_replace("%s", $this->crop_id->caption(), $this->crop_id->RequiredErrorMessage));
            }
        }
        if ($this->variety->Required) {
            if (!$this->variety->IsDetailKey && EmptyValue($this->variety->FormValue)) {
                $this->variety->addErrorMessage(str_replace("%s", $this->variety->caption(), $this->variety->RequiredErrorMessage));
            }
        }
        if ($this->crop_type->Required) {
            if (!$this->crop_type->IsDetailKey && EmptyValue($this->crop_type->FormValue)) {
                $this->crop_type->addErrorMessage(str_replace("%s", $this->crop_type->caption(), $this->crop_type->RequiredErrorMessage));
            }
        }
        if ($this->job_type->Required) {
            if (!$this->job_type->IsDetailKey && EmptyValue($this->job_type->FormValue)) {
                $this->job_type->addErrorMessage(str_replace("%s", $this->job_type->caption(), $this->job_type->RequiredErrorMessage));
            }
        }
        if ($this->assigned_by->Required) {
            if (!$this->assigned_by->IsDetailKey && EmptyValue($this->assigned_by->FormValue)) {
                $this->assigned_by->addErrorMessage(str_replace("%s", $this->assigned_by->caption(), $this->assigned_by->RequiredErrorMessage));
            }
        }
        if ($this->_title->Required) {
            if (!$this->_title->IsDetailKey && EmptyValue($this->_title->FormValue)) {
                $this->_title->addErrorMessage(str_replace("%s", $this->_title->caption(), $this->_title->RequiredErrorMessage));
            }
        }
        if ($this->job_date->Required) {
            if (!$this->job_date->IsDetailKey && EmptyValue($this->job_date->FormValue)) {
                $this->job_date->addErrorMessage(str_replace("%s", $this->job_date->caption(), $this->job_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->job_date->FormValue, $this->job_date->formatPattern())) {
            $this->job_date->addErrorMessage($this->job_date->getErrorMessage(false));
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->stage_one_completed->Required) {
            if ($this->stage_one_completed->FormValue == "") {
                $this->stage_one_completed->addErrorMessage(str_replace("%s", $this->stage_one_completed->caption(), $this->stage_one_completed->RequiredErrorMessage));
            }
        }
        if ($this->stage_two_completed->Required) {
            if ($this->stage_two_completed->FormValue == "") {
                $this->stage_two_completed->addErrorMessage(str_replace("%s", $this->stage_two_completed->caption(), $this->stage_two_completed->RequiredErrorMessage));
            }
        }
        if ($this->stage_three_completed->Required) {
            if ($this->stage_three_completed->FormValue == "") {
                $this->stage_three_completed->addErrorMessage(str_replace("%s", $this->stage_three_completed->caption(), $this->stage_three_completed->RequiredErrorMessage));
            }
        }
        if ($this->sow_date->Required) {
            if (!$this->sow_date->IsDetailKey && EmptyValue($this->sow_date->FormValue)) {
                $this->sow_date->addErrorMessage(str_replace("%s", $this->sow_date->caption(), $this->sow_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->sow_date->FormValue, $this->sow_date->formatPattern())) {
            $this->sow_date->addErrorMessage($this->sow_date->getErrorMessage(false));
        }
        if ($this->plant_date->Required) {
            if (!$this->plant_date->IsDetailKey && EmptyValue($this->plant_date->FormValue)) {
                $this->plant_date->addErrorMessage(str_replace("%s", $this->plant_date->caption(), $this->plant_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->plant_date->FormValue, $this->plant_date->formatPattern())) {
            $this->plant_date->addErrorMessage($this->plant_date->getErrorMessage(false));
        }
        if ($this->harvest_start_date->Required) {
            if (!$this->harvest_start_date->IsDetailKey && EmptyValue($this->harvest_start_date->FormValue)) {
                $this->harvest_start_date->addErrorMessage(str_replace("%s", $this->harvest_start_date->caption(), $this->harvest_start_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->harvest_start_date->FormValue, $this->harvest_start_date->formatPattern())) {
            $this->harvest_start_date->addErrorMessage($this->harvest_start_date->getErrorMessage(false));
        }
        if ($this->harvest_end_date->Required) {
            if (!$this->harvest_end_date->IsDetailKey && EmptyValue($this->harvest_end_date->FormValue)) {
                $this->harvest_end_date->addErrorMessage(str_replace("%s", $this->harvest_end_date->caption(), $this->harvest_end_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->harvest_end_date->FormValue, $this->harvest_end_date->formatPattern())) {
            $this->harvest_end_date->addErrorMessage($this->harvest_end_date->getErrorMessage(false));
        }
        if ($this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->updated_at->FormValue, $this->updated_at->formatPattern())) {
            $this->updated_at->addErrorMessage($this->updated_at->getErrorMessage(false));
        }
        if ($this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->created_at->FormValue, $this->created_at->formatPattern())) {
            $this->created_at->addErrorMessage($this->created_at->getErrorMessage(false));
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

        // user_id
        $this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, "{00000000-0000-0000-0000-000000000000}", $this->user_id->ReadOnly);

        // crop_id
        $this->crop_id->setDbValueDef($rsnew, $this->crop_id->CurrentValue, "{00000000-0000-0000-0000-000000000000}", $this->crop_id->ReadOnly);

        // variety
        $this->variety->setDbValueDef($rsnew, $this->variety->CurrentValue, null, $this->variety->ReadOnly);

        // crop_type
        $this->crop_type->setDbValueDef($rsnew, $this->crop_type->CurrentValue, null, $this->crop_type->ReadOnly);

        // job_type
        $this->job_type->setDbValueDef($rsnew, $this->job_type->CurrentValue, "", $this->job_type->ReadOnly);

        // assigned_by
        $this->assigned_by->setDbValueDef($rsnew, $this->assigned_by->CurrentValue, null, $this->assigned_by->ReadOnly);

        // title
        $this->_title->setDbValueDef($rsnew, $this->_title->CurrentValue, null, $this->_title->ReadOnly);

        // job_date
        $this->job_date->setDbValueDef($rsnew, UnFormatDateTime($this->job_date->CurrentValue, $this->job_date->formatPattern()), null, $this->job_date->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

        // stage_one_completed
        $tmpBool = $this->stage_one_completed->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->stage_one_completed->setDbValueDef($rsnew, $tmpBool, null, $this->stage_one_completed->ReadOnly);

        // stage_two_completed
        $tmpBool = $this->stage_two_completed->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->stage_two_completed->setDbValueDef($rsnew, $tmpBool, null, $this->stage_two_completed->ReadOnly);

        // stage_three_completed
        $tmpBool = $this->stage_three_completed->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->stage_three_completed->setDbValueDef($rsnew, $tmpBool, null, $this->stage_three_completed->ReadOnly);

        // sow_date
        $this->sow_date->setDbValueDef($rsnew, UnFormatDateTime($this->sow_date->CurrentValue, $this->sow_date->formatPattern()), null, $this->sow_date->ReadOnly);

        // plant_date
        $this->plant_date->setDbValueDef($rsnew, UnFormatDateTime($this->plant_date->CurrentValue, $this->plant_date->formatPattern()), null, $this->plant_date->ReadOnly);

        // harvest_start_date
        $this->harvest_start_date->setDbValueDef($rsnew, UnFormatDateTime($this->harvest_start_date->CurrentValue, $this->harvest_start_date->formatPattern()), null, $this->harvest_start_date->ReadOnly);

        // harvest_end_date
        $this->harvest_end_date->setDbValueDef($rsnew, UnFormatDateTime($this->harvest_end_date->CurrentValue, $this->harvest_end_date->formatPattern()), null, $this->harvest_end_date->ReadOnly);

        // updated_at
        $this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()), null, $this->updated_at->ReadOnly);

        // created_at
        $this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()), null, $this->created_at->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jobslist"), "", $this->TableVar, true);
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
                case "x_user_id":
                    break;
                case "x_crop_id":
                    break;
                case "x_job_type":
                    break;
                case "x_status":
                    break;
                case "x_stage_one_completed":
                    break;
                case "x_stage_two_completed":
                    break;
                case "x_stage_three_completed":
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
