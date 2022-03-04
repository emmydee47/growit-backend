<?php

namespace PHPMaker2022\growit_2021;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for crop_months
 */
class CropMonths extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $crop_id;
    public $sow_under_cover_from;
    public $sow_under_cover_to;
    public $sow_direct_from;
    public $sow_direct_to;
    public $plant_start_month;
    public $plant_end_month;
    public $harvest_start_month;
    public $harvest_end_month;
    public $updated_at;
    public $created_at;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'crop_months';
        $this->TableName = 'crop_months';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "\"crop_months\"";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'crop_months',
            'crop_months',
            'x_id',
            'id',
            '"id"',
            'CAST("id" AS varchar(255))',
            72,
            16,
            -1,
            false,
            '"id"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->id->InputTextType = "text";
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Nullable = false; // NOT NULL field
        $this->id->Required = true; // Required field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectGUID");
        $this->Fields['id'] = &$this->id;

        // crop_id
        $this->crop_id = new DbField(
            'crop_months',
            'crop_months',
            'x_crop_id',
            'crop_id',
            '"crop_id"',
            'CAST("crop_id" AS varchar(255))',
            72,
            16,
            -1,
            false,
            '"crop_id"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->crop_id->InputTextType = "text";
        $this->crop_id->Nullable = false; // NOT NULL field
        $this->crop_id->Required = true; // Required field
        $this->crop_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->crop_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->crop_id->Lookup = new Lookup('crop_id', 'crops', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "\"name\"");
        $this->crop_id->DefaultErrorMessage = $Language->phrase("IncorrectGUID");
        $this->Fields['crop_id'] = &$this->crop_id;

        // sow_under_cover_from
        $this->sow_under_cover_from = new DbField(
            'crop_months',
            'crop_months',
            'x_sow_under_cover_from',
            'sow_under_cover_from',
            '"sow_under_cover_from"',
            '"sow_under_cover_from"',
            201,
            0,
            -1,
            false,
            '"sow_under_cover_from"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->sow_under_cover_from->InputTextType = "text";
        $this->sow_under_cover_from->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->sow_under_cover_from->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->sow_under_cover_from->Lookup = new Lookup('sow_under_cover_from', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->sow_under_cover_from->OptionCount = 12;
        $this->Fields['sow_under_cover_from'] = &$this->sow_under_cover_from;

        // sow_under_cover_to
        $this->sow_under_cover_to = new DbField(
            'crop_months',
            'crop_months',
            'x_sow_under_cover_to',
            'sow_under_cover_to',
            '"sow_under_cover_to"',
            '"sow_under_cover_to"',
            201,
            0,
            -1,
            false,
            '"sow_under_cover_to"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->sow_under_cover_to->InputTextType = "text";
        $this->sow_under_cover_to->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->sow_under_cover_to->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->sow_under_cover_to->Lookup = new Lookup('sow_under_cover_to', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->sow_under_cover_to->OptionCount = 12;
        $this->Fields['sow_under_cover_to'] = &$this->sow_under_cover_to;

        // sow_direct_from
        $this->sow_direct_from = new DbField(
            'crop_months',
            'crop_months',
            'x_sow_direct_from',
            'sow_direct_from',
            '"sow_direct_from"',
            '"sow_direct_from"',
            201,
            0,
            -1,
            false,
            '"sow_direct_from"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->sow_direct_from->InputTextType = "text";
        $this->sow_direct_from->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->sow_direct_from->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->sow_direct_from->Lookup = new Lookup('sow_direct_from', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->sow_direct_from->OptionCount = 12;
        $this->Fields['sow_direct_from'] = &$this->sow_direct_from;

        // sow_direct_to
        $this->sow_direct_to = new DbField(
            'crop_months',
            'crop_months',
            'x_sow_direct_to',
            'sow_direct_to',
            '"sow_direct_to"',
            '"sow_direct_to"',
            201,
            0,
            -1,
            false,
            '"sow_direct_to"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->sow_direct_to->InputTextType = "text";
        $this->sow_direct_to->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->sow_direct_to->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->sow_direct_to->Lookup = new Lookup('sow_direct_to', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->sow_direct_to->OptionCount = 12;
        $this->Fields['sow_direct_to'] = &$this->sow_direct_to;

        // plant_start_month
        $this->plant_start_month = new DbField(
            'crop_months',
            'crop_months',
            'x_plant_start_month',
            'plant_start_month',
            '"plant_start_month"',
            '"plant_start_month"',
            200,
            255,
            -1,
            false,
            '"plant_start_month"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->plant_start_month->InputTextType = "text";
        $this->plant_start_month->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->plant_start_month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->plant_start_month->Lookup = new Lookup('plant_start_month', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->plant_start_month->OptionCount = 12;
        $this->Fields['plant_start_month'] = &$this->plant_start_month;

        // plant_end_month
        $this->plant_end_month = new DbField(
            'crop_months',
            'crop_months',
            'x_plant_end_month',
            'plant_end_month',
            '"plant_end_month"',
            '"plant_end_month"',
            200,
            255,
            -1,
            false,
            '"plant_end_month"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->plant_end_month->InputTextType = "text";
        $this->plant_end_month->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->plant_end_month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->plant_end_month->Lookup = new Lookup('plant_end_month', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->plant_end_month->OptionCount = 12;
        $this->Fields['plant_end_month'] = &$this->plant_end_month;

        // harvest_start_month
        $this->harvest_start_month = new DbField(
            'crop_months',
            'crop_months',
            'x_harvest_start_month',
            'harvest_start_month',
            '"harvest_start_month"',
            '"harvest_start_month"',
            200,
            255,
            -1,
            false,
            '"harvest_start_month"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->harvest_start_month->InputTextType = "text";
        $this->harvest_start_month->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->harvest_start_month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->harvest_start_month->Lookup = new Lookup('harvest_start_month', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->harvest_start_month->OptionCount = 12;
        $this->Fields['harvest_start_month'] = &$this->harvest_start_month;

        // harvest_end_month
        $this->harvest_end_month = new DbField(
            'crop_months',
            'crop_months',
            'x_harvest_end_month',
            'harvest_end_month',
            '"harvest_end_month"',
            '"harvest_end_month"',
            200,
            255,
            -1,
            false,
            '"harvest_end_month"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->harvest_end_month->InputTextType = "text";
        $this->harvest_end_month->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->harvest_end_month->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->harvest_end_month->Lookup = new Lookup('harvest_end_month', 'crop_months', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->harvest_end_month->OptionCount = 12;
        $this->Fields['harvest_end_month'] = &$this->harvest_end_month;

        // updated_at
        $this->updated_at = new DbField(
            'crop_months',
            'crop_months',
            'x_updated_at',
            'updated_at',
            '"updated_at"',
            CastDateFieldForLike("\"updated_at\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"updated_at"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->updated_at->InputTextType = "text";
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['updated_at'] = &$this->updated_at;

        // created_at
        $this->created_at = new DbField(
            'crop_months',
            'crop_months',
            'x_created_at',
            'created_at',
            '"created_at"',
            CastDateFieldForLike("\"created_at\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"created_at"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->created_at->InputTextType = "text";
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created_at'] = &$this->created_at;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "\"crop_months\"";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->crop_id->DbValue = $row['crop_id'];
        $this->sow_under_cover_from->DbValue = $row['sow_under_cover_from'];
        $this->sow_under_cover_to->DbValue = $row['sow_under_cover_to'];
        $this->sow_direct_from->DbValue = $row['sow_direct_from'];
        $this->sow_direct_to->DbValue = $row['sow_direct_to'];
        $this->plant_start_month->DbValue = $row['plant_start_month'];
        $this->plant_end_month->DbValue = $row['plant_end_month'];
        $this->harvest_start_month->DbValue = $row['harvest_start_month'];
        $this->harvest_end_month->DbValue = $row['harvest_end_month'];
        $this->updated_at->DbValue = $row['updated_at'];
        $this->created_at->DbValue = $row['created_at'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "\"id\" = '@id@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("cropmonthslist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "cropmonthsview") {
            return $Language->phrase("View");
        } elseif ($pageName == "cropmonthsedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "cropmonthsadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "CropMonthsView";
            case Config("API_ADD_ACTION"):
                return "CropMonthsAdd";
            case Config("API_EDIT_ACTION"):
                return "CropMonthsEdit";
            case Config("API_DELETE_ACTION"):
                return "CropMonthsDelete";
            case Config("API_LIST_ACTION"):
                return "CropMonthsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "cropmonthslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("cropmonthsview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("cropmonthsview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "cropmonthsadd?" . $this->getUrlParm($parm);
        } else {
            $url = "cropmonthsadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("cropmonthsedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("cropmonthsadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("cropmonthsdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id->setDbValue($row['id']);
        $this->crop_id->setDbValue($row['crop_id']);
        $this->sow_under_cover_from->setDbValue($row['sow_under_cover_from']);
        $this->sow_under_cover_to->setDbValue($row['sow_under_cover_to']);
        $this->sow_direct_from->setDbValue($row['sow_direct_from']);
        $this->sow_direct_to->setDbValue($row['sow_direct_to']);
        $this->plant_start_month->setDbValue($row['plant_start_month']);
        $this->plant_end_month->setDbValue($row['plant_end_month']);
        $this->harvest_start_month->setDbValue($row['harvest_start_month']);
        $this->harvest_end_month->setDbValue($row['harvest_end_month']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->created_at->setDbValue($row['created_at']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // crop_id

        // sow_under_cover_from

        // sow_under_cover_to

        // sow_direct_from

        // sow_direct_to

        // plant_start_month

        // plant_end_month

        // harvest_start_month

        // harvest_end_month

        // updated_at

        // created_at

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

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

        // sow_under_cover_from
        if (strval($this->sow_under_cover_from->CurrentValue) != "") {
            $this->sow_under_cover_from->ViewValue = $this->sow_under_cover_from->optionCaption($this->sow_under_cover_from->CurrentValue);
        } else {
            $this->sow_under_cover_from->ViewValue = null;
        }
        $this->sow_under_cover_from->ViewCustomAttributes = "";

        // sow_under_cover_to
        if (strval($this->sow_under_cover_to->CurrentValue) != "") {
            $this->sow_under_cover_to->ViewValue = $this->sow_under_cover_to->optionCaption($this->sow_under_cover_to->CurrentValue);
        } else {
            $this->sow_under_cover_to->ViewValue = null;
        }
        $this->sow_under_cover_to->ViewCustomAttributes = "";

        // sow_direct_from
        if (strval($this->sow_direct_from->CurrentValue) != "") {
            $this->sow_direct_from->ViewValue = $this->sow_direct_from->optionCaption($this->sow_direct_from->CurrentValue);
        } else {
            $this->sow_direct_from->ViewValue = null;
        }
        $this->sow_direct_from->ViewCustomAttributes = "";

        // sow_direct_to
        if (strval($this->sow_direct_to->CurrentValue) != "") {
            $this->sow_direct_to->ViewValue = $this->sow_direct_to->optionCaption($this->sow_direct_to->CurrentValue);
        } else {
            $this->sow_direct_to->ViewValue = null;
        }
        $this->sow_direct_to->ViewCustomAttributes = "";

        // plant_start_month
        if (strval($this->plant_start_month->CurrentValue) != "") {
            $this->plant_start_month->ViewValue = $this->plant_start_month->optionCaption($this->plant_start_month->CurrentValue);
        } else {
            $this->plant_start_month->ViewValue = null;
        }
        $this->plant_start_month->ViewCustomAttributes = "";

        // plant_end_month
        if (strval($this->plant_end_month->CurrentValue) != "") {
            $this->plant_end_month->ViewValue = $this->plant_end_month->optionCaption($this->plant_end_month->CurrentValue);
        } else {
            $this->plant_end_month->ViewValue = null;
        }
        $this->plant_end_month->ViewCustomAttributes = "";

        // harvest_start_month
        if (strval($this->harvest_start_month->CurrentValue) != "") {
            $this->harvest_start_month->ViewValue = $this->harvest_start_month->optionCaption($this->harvest_start_month->CurrentValue);
        } else {
            $this->harvest_start_month->ViewValue = null;
        }
        $this->harvest_start_month->ViewCustomAttributes = "";

        // harvest_end_month
        if (strval($this->harvest_end_month->CurrentValue) != "") {
            $this->harvest_end_month->ViewValue = $this->harvest_end_month->optionCaption($this->harvest_end_month->CurrentValue);
        } else {
            $this->harvest_end_month->ViewValue = null;
        }
        $this->harvest_end_month->ViewCustomAttributes = "";

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
        $this->id->TooltipValue = "";

        // crop_id
        $this->crop_id->LinkCustomAttributes = "";
        $this->crop_id->HrefValue = "";
        $this->crop_id->TooltipValue = "";

        // sow_under_cover_from
        $this->sow_under_cover_from->LinkCustomAttributes = "";
        $this->sow_under_cover_from->HrefValue = "";
        $this->sow_under_cover_from->TooltipValue = "";

        // sow_under_cover_to
        $this->sow_under_cover_to->LinkCustomAttributes = "";
        $this->sow_under_cover_to->HrefValue = "";
        $this->sow_under_cover_to->TooltipValue = "";

        // sow_direct_from
        $this->sow_direct_from->LinkCustomAttributes = "";
        $this->sow_direct_from->HrefValue = "";
        $this->sow_direct_from->TooltipValue = "";

        // sow_direct_to
        $this->sow_direct_to->LinkCustomAttributes = "";
        $this->sow_direct_to->HrefValue = "";
        $this->sow_direct_to->TooltipValue = "";

        // plant_start_month
        $this->plant_start_month->LinkCustomAttributes = "";
        $this->plant_start_month->HrefValue = "";
        $this->plant_start_month->TooltipValue = "";

        // plant_end_month
        $this->plant_end_month->LinkCustomAttributes = "";
        $this->plant_end_month->HrefValue = "";
        $this->plant_end_month->TooltipValue = "";

        // harvest_start_month
        $this->harvest_start_month->LinkCustomAttributes = "";
        $this->harvest_start_month->HrefValue = "";
        $this->harvest_start_month->TooltipValue = "";

        // harvest_end_month
        $this->harvest_end_month->LinkCustomAttributes = "";
        $this->harvest_end_month->HrefValue = "";
        $this->harvest_end_month->TooltipValue = "";

        // updated_at
        $this->updated_at->LinkCustomAttributes = "";
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

        // created_at
        $this->created_at->LinkCustomAttributes = "";
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());

        // crop_id
        $this->crop_id->setupEditAttributes();
        $this->crop_id->EditCustomAttributes = "";
        $this->crop_id->PlaceHolder = RemoveHtml($this->crop_id->caption());

        // sow_under_cover_from
        $this->sow_under_cover_from->setupEditAttributes();
        $this->sow_under_cover_from->EditCustomAttributes = "";
        $this->sow_under_cover_from->EditValue = $this->sow_under_cover_from->options(true);
        $this->sow_under_cover_from->PlaceHolder = RemoveHtml($this->sow_under_cover_from->caption());

        // sow_under_cover_to
        $this->sow_under_cover_to->setupEditAttributes();
        $this->sow_under_cover_to->EditCustomAttributes = "";
        $this->sow_under_cover_to->EditValue = $this->sow_under_cover_to->options(true);
        $this->sow_under_cover_to->PlaceHolder = RemoveHtml($this->sow_under_cover_to->caption());

        // sow_direct_from
        $this->sow_direct_from->setupEditAttributes();
        $this->sow_direct_from->EditCustomAttributes = "";
        $this->sow_direct_from->EditValue = $this->sow_direct_from->options(true);
        $this->sow_direct_from->PlaceHolder = RemoveHtml($this->sow_direct_from->caption());

        // sow_direct_to
        $this->sow_direct_to->setupEditAttributes();
        $this->sow_direct_to->EditCustomAttributes = "";
        $this->sow_direct_to->EditValue = $this->sow_direct_to->options(true);
        $this->sow_direct_to->PlaceHolder = RemoveHtml($this->sow_direct_to->caption());

        // plant_start_month
        $this->plant_start_month->setupEditAttributes();
        $this->plant_start_month->EditCustomAttributes = "";
        $this->plant_start_month->EditValue = $this->plant_start_month->options(true);
        $this->plant_start_month->PlaceHolder = RemoveHtml($this->plant_start_month->caption());

        // plant_end_month
        $this->plant_end_month->setupEditAttributes();
        $this->plant_end_month->EditCustomAttributes = "";
        $this->plant_end_month->EditValue = $this->plant_end_month->options(true);
        $this->plant_end_month->PlaceHolder = RemoveHtml($this->plant_end_month->caption());

        // harvest_start_month
        $this->harvest_start_month->setupEditAttributes();
        $this->harvest_start_month->EditCustomAttributes = "";
        $this->harvest_start_month->EditValue = $this->harvest_start_month->options(true);
        $this->harvest_start_month->PlaceHolder = RemoveHtml($this->harvest_start_month->caption());

        // harvest_end_month
        $this->harvest_end_month->setupEditAttributes();
        $this->harvest_end_month->EditCustomAttributes = "";
        $this->harvest_end_month->EditValue = $this->harvest_end_month->options(true);
        $this->harvest_end_month->PlaceHolder = RemoveHtml($this->harvest_end_month->caption());

        // updated_at
        $this->updated_at->setupEditAttributes();
        $this->updated_at->EditCustomAttributes = "";
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

        // created_at
        $this->created_at->setupEditAttributes();
        $this->created_at->EditCustomAttributes = "";
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->crop_id);
                    $doc->exportCaption($this->sow_under_cover_from);
                    $doc->exportCaption($this->sow_under_cover_to);
                    $doc->exportCaption($this->sow_direct_from);
                    $doc->exportCaption($this->sow_direct_to);
                    $doc->exportCaption($this->plant_start_month);
                    $doc->exportCaption($this->plant_end_month);
                    $doc->exportCaption($this->harvest_start_month);
                    $doc->exportCaption($this->harvest_end_month);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->created_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->crop_id);
                    $doc->exportCaption($this->plant_start_month);
                    $doc->exportCaption($this->plant_end_month);
                    $doc->exportCaption($this->harvest_start_month);
                    $doc->exportCaption($this->harvest_end_month);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->created_at);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->crop_id);
                        $doc->exportField($this->sow_under_cover_from);
                        $doc->exportField($this->sow_under_cover_to);
                        $doc->exportField($this->sow_direct_from);
                        $doc->exportField($this->sow_direct_to);
                        $doc->exportField($this->plant_start_month);
                        $doc->exportField($this->plant_end_month);
                        $doc->exportField($this->harvest_start_month);
                        $doc->exportField($this->harvest_end_month);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->created_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->crop_id);
                        $doc->exportField($this->plant_start_month);
                        $doc->exportField($this->plant_end_month);
                        $doc->exportField($this->harvest_start_month);
                        $doc->exportField($this->harvest_end_month);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->created_at);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
