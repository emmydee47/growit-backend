<?php

namespace PHPMaker2022\growit_2021;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for Plant List
 */
class PlantList extends DbTable
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
    public $user_id;
    public $crop_id;
    public $variety;
    public $crop_type;
    public $job_type;
    public $_title;
    public $job_date;
    public $status;
    public $stage_one_completed;
    public $stage_two_completed;
    public $sow_date;
    public $stage_three_completed;
    public $plant_date;
    public $harvest_start_date;
    public $harvest_end_date;
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
        $this->TableVar = 'PlantList';
        $this->TableName = 'Plant List';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "jobs";
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
            'PlantList',
            'Plant List',
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectGUID");
        $this->Fields['id'] = &$this->id;

        // user_id
        $this->user_id = new DbField(
            'PlantList',
            'Plant List',
            'x_user_id',
            'user_id',
            '"user_id"',
            'CAST("user_id" AS varchar(255))',
            72,
            16,
            -1,
            false,
            '"user_id"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->user_id->InputTextType = "text";
        $this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectGUID");
        $this->Fields['user_id'] = &$this->user_id;

        // crop_id
        $this->crop_id = new DbField(
            'PlantList',
            'Plant List',
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
            'TEXT'
        );
        $this->crop_id->InputTextType = "text";
        $this->crop_id->DefaultErrorMessage = $Language->phrase("IncorrectGUID");
        $this->Fields['crop_id'] = &$this->crop_id;

        // variety
        $this->variety = new DbField(
            'PlantList',
            'Plant List',
            'x_variety',
            'variety',
            '"variety"',
            '"variety"',
            200,
            255,
            -1,
            false,
            '"variety"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->variety->InputTextType = "text";
        $this->Fields['variety'] = &$this->variety;

        // crop_type
        $this->crop_type = new DbField(
            'PlantList',
            'Plant List',
            'x_crop_type',
            'crop_type',
            '"crop_type"',
            '"crop_type"',
            200,
            255,
            -1,
            false,
            '"crop_type"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->crop_type->InputTextType = "text";
        $this->Fields['crop_type'] = &$this->crop_type;

        // job_type
        $this->job_type = new DbField(
            'PlantList',
            'Plant List',
            'x_job_type',
            'job_type',
            '"job_type"',
            '"job_type"',
            200,
            255,
            -1,
            false,
            '"job_type"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->job_type->InputTextType = "text";
        $this->Fields['job_type'] = &$this->job_type;

        // title
        $this->_title = new DbField(
            'PlantList',
            'Plant List',
            'x__title',
            'title',
            '"title"',
            '"title"',
            200,
            255,
            -1,
            false,
            '"title"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_title->InputTextType = "text";
        $this->Fields['title'] = &$this->_title;

        // job_date
        $this->job_date = new DbField(
            'PlantList',
            'Plant List',
            'x_job_date',
            'job_date',
            '"job_date"',
            CastDateFieldForLike("\"job_date\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"job_date"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->job_date->InputTextType = "text";
        $this->job_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['job_date'] = &$this->job_date;

        // status
        $this->status = new DbField(
            'PlantList',
            'Plant List',
            'x_status',
            'status',
            '"status"',
            '"status"',
            200,
            255,
            -1,
            false,
            '"status"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->status->InputTextType = "text";
        $this->Fields['status'] = &$this->status;

        // stage_one_completed
        $this->stage_one_completed = new DbField(
            'PlantList',
            'Plant List',
            'x_stage_one_completed',
            'stage_one_completed',
            '"stage_one_completed"',
            'CAST("stage_one_completed" AS varchar(255))',
            11,
            1,
            -1,
            false,
            '"stage_one_completed"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->stage_one_completed->InputTextType = "text";
        $this->stage_one_completed->DataType = DATATYPE_BOOLEAN;
        $this->stage_one_completed->Lookup = new Lookup('stage_one_completed', 'PlantList', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->stage_one_completed->OptionCount = 2;
        $this->Fields['stage_one_completed'] = &$this->stage_one_completed;

        // stage_two_completed
        $this->stage_two_completed = new DbField(
            'PlantList',
            'Plant List',
            'x_stage_two_completed',
            'stage_two_completed',
            '"stage_two_completed"',
            'CAST("stage_two_completed" AS varchar(255))',
            11,
            1,
            -1,
            false,
            '"stage_two_completed"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->stage_two_completed->InputTextType = "text";
        $this->stage_two_completed->DataType = DATATYPE_BOOLEAN;
        $this->stage_two_completed->Lookup = new Lookup('stage_two_completed', 'PlantList', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->stage_two_completed->OptionCount = 2;
        $this->Fields['stage_two_completed'] = &$this->stage_two_completed;

        // sow_date
        $this->sow_date = new DbField(
            'PlantList',
            'Plant List',
            'x_sow_date',
            'sow_date',
            '"sow_date"',
            CastDateFieldForLike("\"sow_date\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"sow_date"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sow_date->InputTextType = "text";
        $this->sow_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['sow_date'] = &$this->sow_date;

        // stage_three_completed
        $this->stage_three_completed = new DbField(
            'PlantList',
            'Plant List',
            'x_stage_three_completed',
            'stage_three_completed',
            '"stage_three_completed"',
            'CAST("stage_three_completed" AS varchar(255))',
            11,
            1,
            -1,
            false,
            '"stage_three_completed"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->stage_three_completed->InputTextType = "text";
        $this->stage_three_completed->DataType = DATATYPE_BOOLEAN;
        $this->stage_three_completed->Lookup = new Lookup('stage_three_completed', 'PlantList', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->stage_three_completed->OptionCount = 2;
        $this->Fields['stage_three_completed'] = &$this->stage_three_completed;

        // plant_date
        $this->plant_date = new DbField(
            'PlantList',
            'Plant List',
            'x_plant_date',
            'plant_date',
            '"plant_date"',
            CastDateFieldForLike("\"plant_date\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"plant_date"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->plant_date->InputTextType = "text";
        $this->plant_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['plant_date'] = &$this->plant_date;

        // harvest_start_date
        $this->harvest_start_date = new DbField(
            'PlantList',
            'Plant List',
            'x_harvest_start_date',
            'harvest_start_date',
            '"harvest_start_date"',
            CastDateFieldForLike("\"harvest_start_date\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"harvest_start_date"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->harvest_start_date->InputTextType = "text";
        $this->harvest_start_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['harvest_start_date'] = &$this->harvest_start_date;

        // harvest_end_date
        $this->harvest_end_date = new DbField(
            'PlantList',
            'Plant List',
            'x_harvest_end_date',
            'harvest_end_date',
            '"harvest_end_date"',
            CastDateFieldForLike("\"harvest_end_date\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"harvest_end_date"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->harvest_end_date->InputTextType = "text";
        $this->harvest_end_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['harvest_end_date'] = &$this->harvest_end_date;

        // updated_at
        $this->updated_at = new DbField(
            'PlantList',
            'Plant List',
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
            'PlantList',
            'Plant List',
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "\"Plant List\"";
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
        $this->user_id->DbValue = $row['user_id'];
        $this->crop_id->DbValue = $row['crop_id'];
        $this->variety->DbValue = $row['variety'];
        $this->crop_type->DbValue = $row['crop_type'];
        $this->job_type->DbValue = $row['job_type'];
        $this->_title->DbValue = $row['title'];
        $this->job_date->DbValue = $row['job_date'];
        $this->status->DbValue = $row['status'];
        $this->stage_one_completed->DbValue = (ConvertToBool($row['stage_one_completed']) ? "1" : "0");
        $this->stage_two_completed->DbValue = (ConvertToBool($row['stage_two_completed']) ? "1" : "0");
        $this->sow_date->DbValue = $row['sow_date'];
        $this->stage_three_completed->DbValue = (ConvertToBool($row['stage_three_completed']) ? "1" : "0");
        $this->plant_date->DbValue = $row['plant_date'];
        $this->harvest_start_date->DbValue = $row['harvest_start_date'];
        $this->harvest_end_date->DbValue = $row['harvest_end_date'];
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
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("plantlistlist");
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
        if ($pageName == "plantlistview") {
            return $Language->phrase("View");
        } elseif ($pageName == "plantlistedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "plantlistadd") {
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
                return "PlantListView";
            case Config("API_ADD_ACTION"):
                return "PlantListAdd";
            case Config("API_EDIT_ACTION"):
                return "PlantListEdit";
            case Config("API_DELETE_ACTION"):
                return "PlantListDelete";
            case Config("API_LIST_ACTION"):
                return "PlantListList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "plantlistlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("plantlistview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("plantlistview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "plantlistadd?" . $this->getUrlParm($parm);
        } else {
            $url = "plantlistadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("plantlistedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("plantlistadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("plantlistdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
        $this->user_id->setDbValue($row['user_id']);
        $this->crop_id->setDbValue($row['crop_id']);
        $this->variety->setDbValue($row['variety']);
        $this->crop_type->setDbValue($row['crop_type']);
        $this->job_type->setDbValue($row['job_type']);
        $this->_title->setDbValue($row['title']);
        $this->job_date->setDbValue($row['job_date']);
        $this->status->setDbValue($row['status']);
        $this->stage_one_completed->setDbValue(ConvertToBool($row['stage_one_completed']) ? "1" : "0");
        $this->stage_two_completed->setDbValue(ConvertToBool($row['stage_two_completed']) ? "1" : "0");
        $this->sow_date->setDbValue($row['sow_date']);
        $this->stage_three_completed->setDbValue(ConvertToBool($row['stage_three_completed']) ? "1" : "0");
        $this->plant_date->setDbValue($row['plant_date']);
        $this->harvest_start_date->setDbValue($row['harvest_start_date']);
        $this->harvest_end_date->setDbValue($row['harvest_end_date']);
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

        // user_id

        // crop_id

        // variety

        // crop_type

        // job_type

        // title

        // job_date

        // status

        // stage_one_completed

        // stage_two_completed

        // sow_date

        // stage_three_completed

        // plant_date

        // harvest_start_date

        // harvest_end_date

        // updated_at

        // created_at

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // user_id
        $this->user_id->ViewValue = $this->user_id->CurrentValue;
        $this->user_id->ViewCustomAttributes = "";

        // crop_id
        $this->crop_id->ViewValue = $this->crop_id->CurrentValue;
        $this->crop_id->ViewCustomAttributes = "";

        // variety
        $this->variety->ViewValue = $this->variety->CurrentValue;
        $this->variety->ViewCustomAttributes = "";

        // crop_type
        $this->crop_type->ViewValue = $this->crop_type->CurrentValue;
        $this->crop_type->ViewCustomAttributes = "";

        // job_type
        $this->job_type->ViewValue = $this->job_type->CurrentValue;
        $this->job_type->ViewCustomAttributes = "";

        // title
        $this->_title->ViewValue = $this->_title->CurrentValue;
        $this->_title->ViewCustomAttributes = "";

        // job_date
        $this->job_date->ViewValue = $this->job_date->CurrentValue;
        $this->job_date->ViewValue = FormatDateTime($this->job_date->ViewValue, $this->job_date->formatPattern());
        $this->job_date->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
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

        // sow_date
        $this->sow_date->ViewValue = $this->sow_date->CurrentValue;
        $this->sow_date->ViewValue = FormatDateTime($this->sow_date->ViewValue, $this->sow_date->formatPattern());
        $this->sow_date->ViewCustomAttributes = "";

        // stage_three_completed
        if (ConvertToBool($this->stage_three_completed->CurrentValue)) {
            $this->stage_three_completed->ViewValue = $this->stage_three_completed->tagCaption(1) != "" ? $this->stage_three_completed->tagCaption(1) : "Yes";
        } else {
            $this->stage_three_completed->ViewValue = $this->stage_three_completed->tagCaption(2) != "" ? $this->stage_three_completed->tagCaption(2) : "No";
        }
        $this->stage_three_completed->ViewCustomAttributes = "";

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
        $this->id->TooltipValue = "";

        // user_id
        $this->user_id->LinkCustomAttributes = "";
        $this->user_id->HrefValue = "";
        $this->user_id->TooltipValue = "";

        // crop_id
        $this->crop_id->LinkCustomAttributes = "";
        $this->crop_id->HrefValue = "";
        $this->crop_id->TooltipValue = "";

        // variety
        $this->variety->LinkCustomAttributes = "";
        $this->variety->HrefValue = "";
        $this->variety->TooltipValue = "";

        // crop_type
        $this->crop_type->LinkCustomAttributes = "";
        $this->crop_type->HrefValue = "";
        $this->crop_type->TooltipValue = "";

        // job_type
        $this->job_type->LinkCustomAttributes = "";
        $this->job_type->HrefValue = "";
        $this->job_type->TooltipValue = "";

        // title
        $this->_title->LinkCustomAttributes = "";
        $this->_title->HrefValue = "";
        $this->_title->TooltipValue = "";

        // job_date
        $this->job_date->LinkCustomAttributes = "";
        $this->job_date->HrefValue = "";
        $this->job_date->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // stage_one_completed
        $this->stage_one_completed->LinkCustomAttributes = "";
        $this->stage_one_completed->HrefValue = "";
        $this->stage_one_completed->TooltipValue = "";

        // stage_two_completed
        $this->stage_two_completed->LinkCustomAttributes = "";
        $this->stage_two_completed->HrefValue = "";
        $this->stage_two_completed->TooltipValue = "";

        // sow_date
        $this->sow_date->LinkCustomAttributes = "";
        $this->sow_date->HrefValue = "";
        $this->sow_date->TooltipValue = "";

        // stage_three_completed
        $this->stage_three_completed->LinkCustomAttributes = "";
        $this->stage_three_completed->HrefValue = "";
        $this->stage_three_completed->TooltipValue = "";

        // plant_date
        $this->plant_date->LinkCustomAttributes = "";
        $this->plant_date->HrefValue = "";
        $this->plant_date->TooltipValue = "";

        // harvest_start_date
        $this->harvest_start_date->LinkCustomAttributes = "";
        $this->harvest_start_date->HrefValue = "";
        $this->harvest_start_date->TooltipValue = "";

        // harvest_end_date
        $this->harvest_end_date->LinkCustomAttributes = "";
        $this->harvest_end_date->HrefValue = "";
        $this->harvest_end_date->TooltipValue = "";

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

        // user_id
        $this->user_id->setupEditAttributes();
        $this->user_id->EditCustomAttributes = "";
        $this->user_id->EditValue = $this->user_id->CurrentValue;
        $this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

        // crop_id
        $this->crop_id->setupEditAttributes();
        $this->crop_id->EditCustomAttributes = "";
        $this->crop_id->EditValue = $this->crop_id->CurrentValue;
        $this->crop_id->PlaceHolder = RemoveHtml($this->crop_id->caption());

        // variety
        $this->variety->setupEditAttributes();
        $this->variety->EditCustomAttributes = "";
        if (!$this->variety->Raw) {
            $this->variety->CurrentValue = HtmlDecode($this->variety->CurrentValue);
        }
        $this->variety->EditValue = $this->variety->CurrentValue;
        $this->variety->PlaceHolder = RemoveHtml($this->variety->caption());

        // crop_type
        $this->crop_type->setupEditAttributes();
        $this->crop_type->EditCustomAttributes = "";
        if (!$this->crop_type->Raw) {
            $this->crop_type->CurrentValue = HtmlDecode($this->crop_type->CurrentValue);
        }
        $this->crop_type->EditValue = $this->crop_type->CurrentValue;
        $this->crop_type->PlaceHolder = RemoveHtml($this->crop_type->caption());

        // job_type
        $this->job_type->setupEditAttributes();
        $this->job_type->EditCustomAttributes = "";
        if (!$this->job_type->Raw) {
            $this->job_type->CurrentValue = HtmlDecode($this->job_type->CurrentValue);
        }
        $this->job_type->EditValue = $this->job_type->CurrentValue;
        $this->job_type->PlaceHolder = RemoveHtml($this->job_type->caption());

        // title
        $this->_title->setupEditAttributes();
        $this->_title->EditCustomAttributes = "";
        if (!$this->_title->Raw) {
            $this->_title->CurrentValue = HtmlDecode($this->_title->CurrentValue);
        }
        $this->_title->EditValue = $this->_title->CurrentValue;
        $this->_title->PlaceHolder = RemoveHtml($this->_title->caption());

        // job_date
        $this->job_date->setupEditAttributes();
        $this->job_date->EditCustomAttributes = "";
        $this->job_date->EditValue = FormatDateTime($this->job_date->CurrentValue, $this->job_date->formatPattern());
        $this->job_date->PlaceHolder = RemoveHtml($this->job_date->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // stage_one_completed
        $this->stage_one_completed->EditCustomAttributes = "";
        $this->stage_one_completed->EditValue = $this->stage_one_completed->options(false);
        $this->stage_one_completed->PlaceHolder = RemoveHtml($this->stage_one_completed->caption());

        // stage_two_completed
        $this->stage_two_completed->EditCustomAttributes = "";
        $this->stage_two_completed->EditValue = $this->stage_two_completed->options(false);
        $this->stage_two_completed->PlaceHolder = RemoveHtml($this->stage_two_completed->caption());

        // sow_date
        $this->sow_date->setupEditAttributes();
        $this->sow_date->EditCustomAttributes = "";
        $this->sow_date->EditValue = FormatDateTime($this->sow_date->CurrentValue, $this->sow_date->formatPattern());
        $this->sow_date->PlaceHolder = RemoveHtml($this->sow_date->caption());

        // stage_three_completed
        $this->stage_three_completed->EditCustomAttributes = "";
        $this->stage_three_completed->EditValue = $this->stage_three_completed->options(false);
        $this->stage_three_completed->PlaceHolder = RemoveHtml($this->stage_three_completed->caption());

        // plant_date
        $this->plant_date->setupEditAttributes();
        $this->plant_date->EditCustomAttributes = "";
        $this->plant_date->EditValue = FormatDateTime($this->plant_date->CurrentValue, $this->plant_date->formatPattern());
        $this->plant_date->PlaceHolder = RemoveHtml($this->plant_date->caption());

        // harvest_start_date
        $this->harvest_start_date->setupEditAttributes();
        $this->harvest_start_date->EditCustomAttributes = "";
        $this->harvest_start_date->EditValue = FormatDateTime($this->harvest_start_date->CurrentValue, $this->harvest_start_date->formatPattern());
        $this->harvest_start_date->PlaceHolder = RemoveHtml($this->harvest_start_date->caption());

        // harvest_end_date
        $this->harvest_end_date->setupEditAttributes();
        $this->harvest_end_date->EditCustomAttributes = "";
        $this->harvest_end_date->EditValue = FormatDateTime($this->harvest_end_date->CurrentValue, $this->harvest_end_date->formatPattern());
        $this->harvest_end_date->PlaceHolder = RemoveHtml($this->harvest_end_date->caption());

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
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->crop_id);
                    $doc->exportCaption($this->variety);
                    $doc->exportCaption($this->crop_type);
                    $doc->exportCaption($this->job_type);
                    $doc->exportCaption($this->_title);
                    $doc->exportCaption($this->job_date);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->stage_one_completed);
                    $doc->exportCaption($this->stage_two_completed);
                    $doc->exportCaption($this->sow_date);
                    $doc->exportCaption($this->stage_three_completed);
                    $doc->exportCaption($this->plant_date);
                    $doc->exportCaption($this->harvest_start_date);
                    $doc->exportCaption($this->harvest_end_date);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->created_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->crop_id);
                    $doc->exportCaption($this->variety);
                    $doc->exportCaption($this->crop_type);
                    $doc->exportCaption($this->job_type);
                    $doc->exportCaption($this->_title);
                    $doc->exportCaption($this->job_date);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->stage_one_completed);
                    $doc->exportCaption($this->stage_two_completed);
                    $doc->exportCaption($this->sow_date);
                    $doc->exportCaption($this->stage_three_completed);
                    $doc->exportCaption($this->plant_date);
                    $doc->exportCaption($this->harvest_start_date);
                    $doc->exportCaption($this->harvest_end_date);
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
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->crop_id);
                        $doc->exportField($this->variety);
                        $doc->exportField($this->crop_type);
                        $doc->exportField($this->job_type);
                        $doc->exportField($this->_title);
                        $doc->exportField($this->job_date);
                        $doc->exportField($this->status);
                        $doc->exportField($this->stage_one_completed);
                        $doc->exportField($this->stage_two_completed);
                        $doc->exportField($this->sow_date);
                        $doc->exportField($this->stage_three_completed);
                        $doc->exportField($this->plant_date);
                        $doc->exportField($this->harvest_start_date);
                        $doc->exportField($this->harvest_end_date);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->created_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->crop_id);
                        $doc->exportField($this->variety);
                        $doc->exportField($this->crop_type);
                        $doc->exportField($this->job_type);
                        $doc->exportField($this->_title);
                        $doc->exportField($this->job_date);
                        $doc->exportField($this->status);
                        $doc->exportField($this->stage_one_completed);
                        $doc->exportField($this->stage_two_completed);
                        $doc->exportField($this->sow_date);
                        $doc->exportField($this->stage_three_completed);
                        $doc->exportField($this->plant_date);
                        $doc->exportField($this->harvest_start_date);
                        $doc->exportField($this->harvest_end_date);
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
