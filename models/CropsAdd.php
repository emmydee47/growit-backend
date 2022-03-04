<?php

namespace PHPMaker2022\growit_2021;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class CropsAdd extends Crops
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'crops';

    // Page object name
    public $PageObjName = "CropsAdd";

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

        // Table object (crops)
        if (!isset($GLOBALS["crops"]) || get_class($GLOBALS["crops"]) == PROJECT_NAMESPACE . "crops") {
            $GLOBALS["crops"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'crops');
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
                $tbl = Container("crops");
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
                    if ($pageName == "cropsview") {
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->name->setVisibility();
        $this->media_url->setVisibility();
        $this->thumbnail_url->Visible = false;
        $this->variety->setVisibility();
        $this->grow_level->setVisibility();
        $this->category->setVisibility();
        $this->life_cycle->setVisibility();
        $this->companion_crops->setVisibility();
        $this->crop_cover_image->setVisibility();
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
        $this->setupLookupOptions($this->grow_level);
        $this->setupLookupOptions($this->category);
        $this->setupLookupOptions($this->life_cycle);
        $this->setupLookupOptions($this->crop_cover_image);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("cropslist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "cropslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "cropsview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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
        $this->media_url->Upload->Index = $CurrentForm->Index;
        $this->media_url->Upload->uploadFile();
        $this->media_url->CurrentValue = $this->media_url->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
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
                $this->id->setFormValue($val);
            }
        }

        // Check field name 'name' first before field var 'x_name'
        $val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
        if (!$this->name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->name->Visible = false; // Disable update for API request
            } else {
                $this->name->setFormValue($val);
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

        // Check field name 'grow_level' first before field var 'x_grow_level'
        $val = $CurrentForm->hasValue("grow_level") ? $CurrentForm->getValue("grow_level") : $CurrentForm->getValue("x_grow_level");
        if (!$this->grow_level->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->grow_level->Visible = false; // Disable update for API request
            } else {
                $this->grow_level->setFormValue($val);
            }
        }

        // Check field name 'category' first before field var 'x_category'
        $val = $CurrentForm->hasValue("category") ? $CurrentForm->getValue("category") : $CurrentForm->getValue("x_category");
        if (!$this->category->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->category->Visible = false; // Disable update for API request
            } else {
                $this->category->setFormValue($val);
            }
        }

        // Check field name 'life_cycle' first before field var 'x_life_cycle'
        $val = $CurrentForm->hasValue("life_cycle") ? $CurrentForm->getValue("life_cycle") : $CurrentForm->getValue("x_life_cycle");
        if (!$this->life_cycle->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->life_cycle->Visible = false; // Disable update for API request
            } else {
                $this->life_cycle->setFormValue($val);
            }
        }

        // Check field name 'companion_crops' first before field var 'x_companion_crops'
        $val = $CurrentForm->hasValue("companion_crops") ? $CurrentForm->getValue("companion_crops") : $CurrentForm->getValue("x_companion_crops");
        if (!$this->companion_crops->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->companion_crops->Visible = false; // Disable update for API request
            } else {
                $this->companion_crops->setFormValue($val);
            }
        }

        // Check field name 'crop_cover_image' first before field var 'x_crop_cover_image'
        $val = $CurrentForm->hasValue("crop_cover_image") ? $CurrentForm->getValue("crop_cover_image") : $CurrentForm->getValue("x_crop_cover_image");
        if (!$this->crop_cover_image->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->crop_cover_image->Visible = false; // Disable update for API request
            } else {
                $this->crop_cover_image->setFormValue($val);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->name->CurrentValue = $this->name->FormValue;
        $this->variety->CurrentValue = $this->variety->FormValue;
        $this->grow_level->CurrentValue = $this->grow_level->FormValue;
        $this->category->CurrentValue = $this->category->FormValue;
        $this->life_cycle->CurrentValue = $this->life_cycle->FormValue;
        $this->companion_crops->CurrentValue = $this->companion_crops->FormValue;
        $this->crop_cover_image->CurrentValue = $this->crop_cover_image->FormValue;
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
        $this->name->setDbValue($row['name']);
        $this->media_url->Upload->DbValue = $row['media_url'];
        $this->media_url->setDbValue($this->media_url->Upload->DbValue);
        $this->thumbnail_url->Upload->DbValue = $row['thumbnail_url'];
        $this->thumbnail_url->setDbValue($this->thumbnail_url->Upload->DbValue);
        $this->variety->setDbValue($row['variety']);
        $this->grow_level->setDbValue($row['grow_level']);
        $this->category->setDbValue($row['category']);
        $this->life_cycle->setDbValue($row['life_cycle']);
        $this->companion_crops->setDbValue($row['companion_crops']);
        $this->crop_cover_image->setDbValue((ConvertToBool($row['crop_cover_image']) ? "1" : "0"));
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['name'] = $this->name->DefaultValue;
        $row['media_url'] = $this->media_url->DefaultValue;
        $row['thumbnail_url'] = $this->thumbnail_url->DefaultValue;
        $row['variety'] = $this->variety->DefaultValue;
        $row['grow_level'] = $this->grow_level->DefaultValue;
        $row['category'] = $this->category->DefaultValue;
        $row['life_cycle'] = $this->life_cycle->DefaultValue;
        $row['companion_crops'] = $this->companion_crops->DefaultValue;
        $row['crop_cover_image'] = $this->crop_cover_image->DefaultValue;
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

        // name
        $this->name->RowCssClass = "row";

        // media_url
        $this->media_url->RowCssClass = "row";

        // thumbnail_url
        $this->thumbnail_url->RowCssClass = "row";

        // variety
        $this->variety->RowCssClass = "row";

        // grow_level
        $this->grow_level->RowCssClass = "row";

        // category
        $this->category->RowCssClass = "row";

        // life_cycle
        $this->life_cycle->RowCssClass = "row";

        // companion_crops
        $this->companion_crops->RowCssClass = "row";

        // crop_cover_image
        $this->crop_cover_image->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // name
            $this->name->ViewValue = $this->name->CurrentValue;
            $this->name->ViewCustomAttributes = "";

            // media_url
            if (!EmptyValue($this->media_url->Upload->DbValue)) {
                $this->media_url->ImageWidth = 80;
                $this->media_url->ImageHeight = 80;
                $this->media_url->ImageAlt = $this->media_url->alt();
                $this->media_url->ImageCssClass = "ew-image";
                $this->media_url->ViewValue = $this->media_url->Upload->DbValue;
            } else {
                $this->media_url->ViewValue = "";
            }
            $this->media_url->ViewCustomAttributes = "";

            // thumbnail_url
            if (!EmptyValue($this->thumbnail_url->Upload->DbValue)) {
                $this->thumbnail_url->ImageWidth = 80;
                $this->thumbnail_url->ImageHeight = 80;
                $this->thumbnail_url->ImageAlt = $this->thumbnail_url->alt();
                $this->thumbnail_url->ImageCssClass = "ew-image";
                $this->thumbnail_url->ViewValue = $this->thumbnail_url->Upload->DbValue;
            } else {
                $this->thumbnail_url->ViewValue = "";
            }
            $this->thumbnail_url->ViewCustomAttributes = "";

            // variety
            $this->variety->ViewValue = $this->variety->CurrentValue;
            $this->variety->ViewCustomAttributes = "";

            // grow_level
            if (strval($this->grow_level->CurrentValue) != "") {
                $this->grow_level->ViewValue = $this->grow_level->optionCaption($this->grow_level->CurrentValue);
            } else {
                $this->grow_level->ViewValue = null;
            }
            $this->grow_level->ViewCustomAttributes = "";

            // category
            if (strval($this->category->CurrentValue) != "") {
                $this->category->ViewValue = $this->category->optionCaption($this->category->CurrentValue);
            } else {
                $this->category->ViewValue = null;
            }
            $this->category->ViewCustomAttributes = "";

            // life_cycle
            if (strval($this->life_cycle->CurrentValue) != "") {
                $this->life_cycle->ViewValue = $this->life_cycle->optionCaption($this->life_cycle->CurrentValue);
            } else {
                $this->life_cycle->ViewValue = null;
            }
            $this->life_cycle->ViewCustomAttributes = "";

            // companion_crops
            $this->companion_crops->ViewValue = $this->companion_crops->CurrentValue;
            $this->companion_crops->ViewCustomAttributes = "";

            // crop_cover_image
            if (ConvertToBool($this->crop_cover_image->CurrentValue)) {
                $this->crop_cover_image->ViewValue = $this->crop_cover_image->tagCaption(1) != "" ? $this->crop_cover_image->tagCaption(1) : "Yes";
            } else {
                $this->crop_cover_image->ViewValue = $this->crop_cover_image->tagCaption(2) != "" ? $this->crop_cover_image->tagCaption(2) : "No";
            }
            $this->crop_cover_image->ViewCustomAttributes = "";

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

            // name
            $this->name->LinkCustomAttributes = "";
            $this->name->HrefValue = "";

            // media_url
            $this->media_url->LinkCustomAttributes = "";
            if (!EmptyValue($this->media_url->Upload->DbValue)) {
                $this->media_url->HrefValue = "https://backend.growit-app.co.uk/" . GetFileUploadUrl($this->media_url, $this->media_url->htmlDecode($this->media_url->Upload->DbValue)); // Add prefix/suffix
                $this->media_url->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->media_url->HrefValue = FullUrl($this->media_url->HrefValue, "href");
                }
            } else {
                $this->media_url->HrefValue = "";
            }
            $this->media_url->ExportHrefValue = $this->media_url->UploadPath . $this->media_url->Upload->DbValue;

            // variety
            $this->variety->LinkCustomAttributes = "";
            $this->variety->HrefValue = "";

            // grow_level
            $this->grow_level->LinkCustomAttributes = "";
            $this->grow_level->HrefValue = "";

            // category
            $this->category->LinkCustomAttributes = "";
            $this->category->HrefValue = "";

            // life_cycle
            $this->life_cycle->LinkCustomAttributes = "";
            $this->life_cycle->HrefValue = "";

            // companion_crops
            $this->companion_crops->LinkCustomAttributes = "";
            $this->companion_crops->HrefValue = "";

            // crop_cover_image
            $this->crop_cover_image->LinkCustomAttributes = "";
            $this->crop_cover_image->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // id

            // name
            $this->name->setupEditAttributes();
            $this->name->EditCustomAttributes = "";
            if (!$this->name->Raw) {
                $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
            }
            $this->name->EditValue = HtmlEncode($this->name->CurrentValue);
            $this->name->PlaceHolder = RemoveHtml($this->name->caption());

            // media_url
            $this->media_url->setupEditAttributes();
            $this->media_url->EditCustomAttributes = "";
            if (!EmptyValue($this->media_url->Upload->DbValue)) {
                $this->media_url->ImageWidth = 80;
                $this->media_url->ImageHeight = 80;
                $this->media_url->ImageAlt = $this->media_url->alt();
                $this->media_url->ImageCssClass = "ew-image";
                $this->media_url->EditValue = $this->media_url->Upload->DbValue;
            } else {
                $this->media_url->EditValue = "";
            }
            if (!EmptyValue($this->media_url->CurrentValue)) {
                $this->media_url->Upload->FileName = $this->media_url->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->media_url);
            }

            // variety
            $this->variety->setupEditAttributes();
            $this->variety->EditCustomAttributes = "";
            if (!$this->variety->Raw) {
                $this->variety->CurrentValue = HtmlDecode($this->variety->CurrentValue);
            }
            $this->variety->EditValue = HtmlEncode($this->variety->CurrentValue);
            $this->variety->PlaceHolder = RemoveHtml($this->variety->caption());

            // grow_level
            $this->grow_level->EditCustomAttributes = "";
            $this->grow_level->EditValue = $this->grow_level->options(false);
            $this->grow_level->PlaceHolder = RemoveHtml($this->grow_level->caption());

            // category
            $this->category->setupEditAttributes();
            $this->category->EditCustomAttributes = "";
            $this->category->EditValue = $this->category->options(true);
            $this->category->PlaceHolder = RemoveHtml($this->category->caption());

            // life_cycle
            $this->life_cycle->setupEditAttributes();
            $this->life_cycle->EditCustomAttributes = "";
            $this->life_cycle->EditValue = $this->life_cycle->options(true);
            $this->life_cycle->PlaceHolder = RemoveHtml($this->life_cycle->caption());

            // companion_crops
            $this->companion_crops->setupEditAttributes();
            $this->companion_crops->EditCustomAttributes = "";
            $this->companion_crops->EditValue = HtmlEncode($this->companion_crops->CurrentValue);
            $this->companion_crops->PlaceHolder = RemoveHtml($this->companion_crops->caption());

            // crop_cover_image
            $this->crop_cover_image->EditCustomAttributes = "";
            $this->crop_cover_image->EditValue = $this->crop_cover_image->options(false);
            $this->crop_cover_image->PlaceHolder = RemoveHtml($this->crop_cover_image->caption());

            // created_at

            // updated_at

            // Add refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // name
            $this->name->LinkCustomAttributes = "";
            $this->name->HrefValue = "";

            // media_url
            $this->media_url->LinkCustomAttributes = "";
            if (!EmptyValue($this->media_url->Upload->DbValue)) {
                $this->media_url->HrefValue = "https://backend.growit-app.co.uk/" . GetFileUploadUrl($this->media_url, $this->media_url->htmlDecode($this->media_url->Upload->DbValue)); // Add prefix/suffix
                $this->media_url->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->media_url->HrefValue = FullUrl($this->media_url->HrefValue, "href");
                }
            } else {
                $this->media_url->HrefValue = "";
            }
            $this->media_url->ExportHrefValue = $this->media_url->UploadPath . $this->media_url->Upload->DbValue;

            // variety
            $this->variety->LinkCustomAttributes = "";
            $this->variety->HrefValue = "";

            // grow_level
            $this->grow_level->LinkCustomAttributes = "";
            $this->grow_level->HrefValue = "";

            // category
            $this->category->LinkCustomAttributes = "";
            $this->category->HrefValue = "";

            // life_cycle
            $this->life_cycle->LinkCustomAttributes = "";
            $this->life_cycle->HrefValue = "";

            // companion_crops
            $this->companion_crops->LinkCustomAttributes = "";
            $this->companion_crops->HrefValue = "";

            // crop_cover_image
            $this->crop_cover_image->LinkCustomAttributes = "";
            $this->crop_cover_image->HrefValue = "";

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
        if ($this->name->Required) {
            if (!$this->name->IsDetailKey && EmptyValue($this->name->FormValue)) {
                $this->name->addErrorMessage(str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
            }
        }
        if ($this->media_url->Required) {
            if ($this->media_url->Upload->FileName == "" && !$this->media_url->Upload->KeepFile) {
                $this->media_url->addErrorMessage(str_replace("%s", $this->media_url->caption(), $this->media_url->RequiredErrorMessage));
            }
        }
        if ($this->variety->Required) {
            if (!$this->variety->IsDetailKey && EmptyValue($this->variety->FormValue)) {
                $this->variety->addErrorMessage(str_replace("%s", $this->variety->caption(), $this->variety->RequiredErrorMessage));
            }
        }
        if ($this->grow_level->Required) {
            if ($this->grow_level->FormValue == "") {
                $this->grow_level->addErrorMessage(str_replace("%s", $this->grow_level->caption(), $this->grow_level->RequiredErrorMessage));
            }
        }
        if ($this->category->Required) {
            if (!$this->category->IsDetailKey && EmptyValue($this->category->FormValue)) {
                $this->category->addErrorMessage(str_replace("%s", $this->category->caption(), $this->category->RequiredErrorMessage));
            }
        }
        if ($this->life_cycle->Required) {
            if (!$this->life_cycle->IsDetailKey && EmptyValue($this->life_cycle->FormValue)) {
                $this->life_cycle->addErrorMessage(str_replace("%s", $this->life_cycle->caption(), $this->life_cycle->RequiredErrorMessage));
            }
        }
        if ($this->companion_crops->Required) {
            if (!$this->companion_crops->IsDetailKey && EmptyValue($this->companion_crops->FormValue)) {
                $this->companion_crops->addErrorMessage(str_replace("%s", $this->companion_crops->caption(), $this->companion_crops->RequiredErrorMessage));
            }
        }
        if ($this->crop_cover_image->Required) {
            if ($this->crop_cover_image->FormValue == "") {
                $this->crop_cover_image->addErrorMessage(str_replace("%s", $this->crop_cover_image->caption(), $this->crop_cover_image->RequiredErrorMessage));
            }
        }
        if ($this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if ($this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // id
        $this->id->CurrentValue = getUUID();
        $this->id->setDbValueDef($rsnew, $this->id->CurrentValue, "{00000000-0000-0000-0000-000000000000}");

        // name
        $this->name->setDbValueDef($rsnew, $this->name->CurrentValue, "", false);

        // media_url
        if ($this->media_url->Visible && !$this->media_url->Upload->KeepFile) {
            $this->media_url->Upload->DbValue = ""; // No need to delete old file
            if ($this->media_url->Upload->FileName == "") {
                $rsnew['media_url'] = null;
            } else {
                $rsnew['media_url'] = $this->media_url->Upload->FileName;
            }
        }

        // variety
        $this->variety->setDbValueDef($rsnew, $this->variety->CurrentValue, null, false);

        // grow_level
        $this->grow_level->setDbValueDef($rsnew, $this->grow_level->CurrentValue, null, false);

        // category
        $this->category->setDbValueDef($rsnew, $this->category->CurrentValue, null, false);

        // life_cycle
        $this->life_cycle->setDbValueDef($rsnew, $this->life_cycle->CurrentValue, "", false);

        // companion_crops
        $this->companion_crops->setDbValueDef($rsnew, $this->companion_crops->CurrentValue, null, false);

        // crop_cover_image
        $tmpBool = $this->crop_cover_image->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->crop_cover_image->setDbValueDef($rsnew, $tmpBool, null, false);

        // created_at
        $this->created_at->CurrentValue = CurrentDateTime();
        $this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue, CurrentDate());

        // updated_at
        $this->updated_at->CurrentValue = CurrentDateTime();
        $this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue, CurrentDate());
        if ($this->media_url->Visible && !$this->media_url->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->media_url->Upload->DbValue) ? [] : [$this->media_url->htmlDecode($this->media_url->Upload->DbValue)];
            if (!EmptyValue($this->media_url->Upload->FileName)) {
                $newFiles = [$this->media_url->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->media_url, $this->media_url->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->media_url->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->media_url->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->media_url->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->media_url->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->media_url->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->media_url->setDbValueDef($rsnew, $this->media_url->Upload->FileName, null, false);
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);
        if ($this->id->CurrentValue != "") { // Check field with unique index
            $filter = "(\"id\" = '" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "')";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->id->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->id->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        if ($rsold) {
        }

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['id']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->media_url->Visible && !$this->media_url->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->media_url->Upload->DbValue) ? [] : [$this->media_url->htmlDecode($this->media_url->Upload->DbValue)];
                    if (!EmptyValue($this->media_url->Upload->FileName)) {
                        $newFiles = [$this->media_url->Upload->FileName];
                        $newFiles2 = [$this->media_url->htmlDecode($rsnew['media_url'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->media_url, $this->media_url->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->media_url->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->media_url->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
            // media_url
            CleanUploadTempPath($this->media_url, $this->media_url->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("cropslist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_grow_level":
                    break;
                case "x_category":
                    break;
                case "x_life_cycle":
                    break;
                case "x_crop_cover_image":
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
