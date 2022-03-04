<?php

namespace PHPMaker2022\growit_2021;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for users
 */
class Users extends DbTable
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
    public $auth_id;
    public $avatar;
    public $_username;
    public $fullname;
    public $_password;
    public $role_id;
    public $_token;
    public $_email;
    public $gender;
    public $date_of_birth;
    public $biography;
    public $last_login;
    public $is_verified;
    public $location;
    public $created_at;
    public $updated_at;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'users';
        $this->TableName = 'users';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "\"users\"";
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
            'users',
            'users',
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

        // auth_id
        $this->auth_id = new DbField(
            'users',
            'users',
            'x_auth_id',
            'auth_id',
            '"auth_id"',
            '"auth_id"',
            200,
            255,
            -1,
            false,
            '"auth_id"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->auth_id->InputTextType = "text";
        $this->Fields['auth_id'] = &$this->auth_id;

        // avatar
        $this->avatar = new DbField(
            'users',
            'users',
            'x_avatar',
            'avatar',
            '"avatar"',
            '"avatar"',
            200,
            255,
            -1,
            false,
            '"avatar"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->avatar->InputTextType = "text";
        $this->Fields['avatar'] = &$this->avatar;

        // username
        $this->_username = new DbField(
            'users',
            'users',
            'x__username',
            'username',
            '"username"',
            '"username"',
            200,
            255,
            -1,
            false,
            '"username"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_username->InputTextType = "text";
        $this->Fields['username'] = &$this->_username;

        // fullname
        $this->fullname = new DbField(
            'users',
            'users',
            'x_fullname',
            'fullname',
            '"fullname"',
            '"fullname"',
            200,
            255,
            -1,
            false,
            '"fullname"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fullname->InputTextType = "text";
        $this->Fields['fullname'] = &$this->fullname;

        // password
        $this->_password = new DbField(
            'users',
            'users',
            'x__password',
            'password',
            '"password"',
            '"password"',
            200,
            255,
            -1,
            false,
            '"password"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_password->InputTextType = "text";
        $this->Fields['password'] = &$this->_password;

        // role_id
        $this->role_id = new DbField(
            'users',
            'users',
            'x_role_id',
            'role_id',
            '"role_id"',
            '"role_id"',
            200,
            255,
            -1,
            false,
            '"role_id"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->role_id->InputTextType = "text";
        $this->role_id->Nullable = false; // NOT NULL field
        $this->role_id->Required = true; // Required field
        $this->Fields['role_id'] = &$this->role_id;

        // token
        $this->_token = new DbField(
            'users',
            'users',
            'x__token',
            'token',
            '"token"',
            '"token"',
            200,
            255,
            -1,
            false,
            '"token"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_token->InputTextType = "text";
        $this->Fields['token'] = &$this->_token;

        // email
        $this->_email = new DbField(
            'users',
            'users',
            'x__email',
            'email',
            '"email"',
            '"email"',
            200,
            255,
            -1,
            false,
            '"email"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_email->InputTextType = "text";
        $this->Fields['email'] = &$this->_email;

        // gender
        $this->gender = new DbField(
            'users',
            'users',
            'x_gender',
            'gender',
            '"gender"',
            '"gender"',
            200,
            255,
            -1,
            false,
            '"gender"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->gender->InputTextType = "text";
        $this->Fields['gender'] = &$this->gender;

        // date_of_birth
        $this->date_of_birth = new DbField(
            'users',
            'users',
            'x_date_of_birth',
            'date_of_birth',
            '"date_of_birth"',
            CastDateFieldForLike("\"date_of_birth\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"date_of_birth"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date_of_birth->InputTextType = "text";
        $this->date_of_birth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date_of_birth'] = &$this->date_of_birth;

        // biography
        $this->biography = new DbField(
            'users',
            'users',
            'x_biography',
            'biography',
            '"biography"',
            '"biography"',
            201,
            0,
            -1,
            false,
            '"biography"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->biography->InputTextType = "text";
        $this->Fields['biography'] = &$this->biography;

        // last_login
        $this->last_login = new DbField(
            'users',
            'users',
            'x_last_login',
            'last_login',
            '"last_login"',
            CastDateFieldForLike("\"last_login\"", 0, "DB"),
            135,
            8,
            0,
            false,
            '"last_login"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->last_login->InputTextType = "text";
        $this->last_login->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['last_login'] = &$this->last_login;

        // is_verified
        $this->is_verified = new DbField(
            'users',
            'users',
            'x_is_verified',
            'is_verified',
            '"is_verified"',
            'CAST("is_verified" AS varchar(255))',
            11,
            1,
            -1,
            false,
            '"is_verified"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->is_verified->InputTextType = "text";
        $this->is_verified->DataType = DATATYPE_BOOLEAN;
        $this->is_verified->Lookup = new Lookup('is_verified', 'users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->is_verified->OptionCount = 2;
        $this->Fields['is_verified'] = &$this->is_verified;

        // location
        $this->location = new DbField(
            'users',
            'users',
            'x_location',
            'location',
            '"location"',
            '"location"',
            200,
            255,
            -1,
            false,
            '"location"',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->location->InputTextType = "text";
        $this->Fields['location'] = &$this->location;

        // created_at
        $this->created_at = new DbField(
            'users',
            'users',
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
        $this->created_at->Nullable = false; // NOT NULL field
        $this->created_at->Required = true; // Required field
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created_at'] = &$this->created_at;

        // updated_at
        $this->updated_at = new DbField(
            'users',
            'users',
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
        $this->updated_at->Nullable = false; // NOT NULL field
        $this->updated_at->Required = true; // Required field
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['updated_at'] = &$this->updated_at;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "\"users\"";
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
        $this->auth_id->DbValue = $row['auth_id'];
        $this->avatar->DbValue = $row['avatar'];
        $this->_username->DbValue = $row['username'];
        $this->fullname->DbValue = $row['fullname'];
        $this->_password->DbValue = $row['password'];
        $this->role_id->DbValue = $row['role_id'];
        $this->_token->DbValue = $row['token'];
        $this->_email->DbValue = $row['email'];
        $this->gender->DbValue = $row['gender'];
        $this->date_of_birth->DbValue = $row['date_of_birth'];
        $this->biography->DbValue = $row['biography'];
        $this->last_login->DbValue = $row['last_login'];
        $this->is_verified->DbValue = (ConvertToBool($row['is_verified']) ? "1" : "0");
        $this->location->DbValue = $row['location'];
        $this->created_at->DbValue = $row['created_at'];
        $this->updated_at->DbValue = $row['updated_at'];
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
        return $_SESSION[$name] ?? GetUrl("userslist");
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
        if ($pageName == "usersview") {
            return $Language->phrase("View");
        } elseif ($pageName == "usersedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "usersadd") {
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
                return "UsersView";
            case Config("API_ADD_ACTION"):
                return "UsersAdd";
            case Config("API_EDIT_ACTION"):
                return "UsersEdit";
            case Config("API_DELETE_ACTION"):
                return "UsersDelete";
            case Config("API_LIST_ACTION"):
                return "UsersList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "userslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("usersview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("usersview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "usersadd?" . $this->getUrlParm($parm);
        } else {
            $url = "usersadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("usersedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("usersadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("usersdelete", $this->getUrlParm());
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
        $this->is_verified->setDbValue(ConvertToBool($row['is_verified']) ? "1" : "0");
        $this->location->setDbValue($row['location']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // auth_id

        // avatar

        // username

        // fullname

        // password

        // role_id

        // token

        // email

        // gender

        // date_of_birth

        // biography

        // last_login

        // is_verified

        // location

        // created_at

        // updated_at

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
        $this->id->TooltipValue = "";

        // auth_id
        $this->auth_id->LinkCustomAttributes = "";
        $this->auth_id->HrefValue = "";
        $this->auth_id->TooltipValue = "";

        // avatar
        $this->avatar->LinkCustomAttributes = "";
        $this->avatar->HrefValue = "";
        $this->avatar->TooltipValue = "";

        // username
        $this->_username->LinkCustomAttributes = "";
        $this->_username->HrefValue = "";
        $this->_username->TooltipValue = "";

        // fullname
        $this->fullname->LinkCustomAttributes = "";
        $this->fullname->HrefValue = "";
        $this->fullname->TooltipValue = "";

        // password
        $this->_password->LinkCustomAttributes = "";
        $this->_password->HrefValue = "";
        $this->_password->TooltipValue = "";

        // role_id
        $this->role_id->LinkCustomAttributes = "";
        $this->role_id->HrefValue = "";
        $this->role_id->TooltipValue = "";

        // token
        $this->_token->LinkCustomAttributes = "";
        $this->_token->HrefValue = "";
        $this->_token->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // gender
        $this->gender->LinkCustomAttributes = "";
        $this->gender->HrefValue = "";
        $this->gender->TooltipValue = "";

        // date_of_birth
        $this->date_of_birth->LinkCustomAttributes = "";
        $this->date_of_birth->HrefValue = "";
        $this->date_of_birth->TooltipValue = "";

        // biography
        $this->biography->LinkCustomAttributes = "";
        $this->biography->HrefValue = "";
        $this->biography->TooltipValue = "";

        // last_login
        $this->last_login->LinkCustomAttributes = "";
        $this->last_login->HrefValue = "";
        $this->last_login->TooltipValue = "";

        // is_verified
        $this->is_verified->LinkCustomAttributes = "";
        $this->is_verified->HrefValue = "";
        $this->is_verified->TooltipValue = "";

        // location
        $this->location->LinkCustomAttributes = "";
        $this->location->HrefValue = "";
        $this->location->TooltipValue = "";

        // created_at
        $this->created_at->LinkCustomAttributes = "";
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // updated_at
        $this->updated_at->LinkCustomAttributes = "";
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

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

        // auth_id
        $this->auth_id->setupEditAttributes();
        $this->auth_id->EditCustomAttributes = "";
        if (!$this->auth_id->Raw) {
            $this->auth_id->CurrentValue = HtmlDecode($this->auth_id->CurrentValue);
        }
        $this->auth_id->EditValue = $this->auth_id->CurrentValue;
        $this->auth_id->PlaceHolder = RemoveHtml($this->auth_id->caption());

        // avatar
        $this->avatar->setupEditAttributes();
        $this->avatar->EditCustomAttributes = "";
        if (!$this->avatar->Raw) {
            $this->avatar->CurrentValue = HtmlDecode($this->avatar->CurrentValue);
        }
        $this->avatar->EditValue = $this->avatar->CurrentValue;
        $this->avatar->PlaceHolder = RemoveHtml($this->avatar->caption());

        // username
        $this->_username->setupEditAttributes();
        $this->_username->EditCustomAttributes = "";
        if (!$this->_username->Raw) {
            $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
        }
        $this->_username->EditValue = $this->_username->CurrentValue;
        $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

        // fullname
        $this->fullname->setupEditAttributes();
        $this->fullname->EditCustomAttributes = "";
        if (!$this->fullname->Raw) {
            $this->fullname->CurrentValue = HtmlDecode($this->fullname->CurrentValue);
        }
        $this->fullname->EditValue = $this->fullname->CurrentValue;
        $this->fullname->PlaceHolder = RemoveHtml($this->fullname->caption());

        // password
        $this->_password->setupEditAttributes();
        $this->_password->EditCustomAttributes = "";
        if (!$this->_password->Raw) {
            $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
        }
        $this->_password->EditValue = $this->_password->CurrentValue;
        $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

        // role_id
        $this->role_id->setupEditAttributes();
        $this->role_id->EditCustomAttributes = "";
        if (!$this->role_id->Raw) {
            $this->role_id->CurrentValue = HtmlDecode($this->role_id->CurrentValue);
        }
        $this->role_id->EditValue = $this->role_id->CurrentValue;
        $this->role_id->PlaceHolder = RemoveHtml($this->role_id->caption());

        // token
        $this->_token->setupEditAttributes();
        $this->_token->EditCustomAttributes = "";
        if (!$this->_token->Raw) {
            $this->_token->CurrentValue = HtmlDecode($this->_token->CurrentValue);
        }
        $this->_token->EditValue = $this->_token->CurrentValue;
        $this->_token->PlaceHolder = RemoveHtml($this->_token->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // gender
        $this->gender->setupEditAttributes();
        $this->gender->EditCustomAttributes = "";
        if (!$this->gender->Raw) {
            $this->gender->CurrentValue = HtmlDecode($this->gender->CurrentValue);
        }
        $this->gender->EditValue = $this->gender->CurrentValue;
        $this->gender->PlaceHolder = RemoveHtml($this->gender->caption());

        // date_of_birth
        $this->date_of_birth->setupEditAttributes();
        $this->date_of_birth->EditCustomAttributes = "";
        $this->date_of_birth->EditValue = FormatDateTime($this->date_of_birth->CurrentValue, $this->date_of_birth->formatPattern());
        $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

        // biography
        $this->biography->setupEditAttributes();
        $this->biography->EditCustomAttributes = "";
        $this->biography->EditValue = $this->biography->CurrentValue;
        $this->biography->PlaceHolder = RemoveHtml($this->biography->caption());

        // last_login
        $this->last_login->setupEditAttributes();
        $this->last_login->EditCustomAttributes = "";
        $this->last_login->EditValue = FormatDateTime($this->last_login->CurrentValue, $this->last_login->formatPattern());
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
        $this->location->EditValue = $this->location->CurrentValue;
        $this->location->PlaceHolder = RemoveHtml($this->location->caption());

        // created_at
        $this->created_at->setupEditAttributes();
        $this->created_at->EditCustomAttributes = "";
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // updated_at
        $this->updated_at->setupEditAttributes();
        $this->updated_at->EditCustomAttributes = "";
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

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
                    $doc->exportCaption($this->auth_id);
                    $doc->exportCaption($this->avatar);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->fullname);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->role_id);
                    $doc->exportCaption($this->_token);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->biography);
                    $doc->exportCaption($this->last_login);
                    $doc->exportCaption($this->is_verified);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->auth_id);
                    $doc->exportCaption($this->avatar);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->fullname);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->role_id);
                    $doc->exportCaption($this->_token);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->last_login);
                    $doc->exportCaption($this->is_verified);
                    $doc->exportCaption($this->location);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
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
                        $doc->exportField($this->auth_id);
                        $doc->exportField($this->avatar);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->fullname);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->role_id);
                        $doc->exportField($this->_token);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->biography);
                        $doc->exportField($this->last_login);
                        $doc->exportField($this->is_verified);
                        $doc->exportField($this->location);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->auth_id);
                        $doc->exportField($this->avatar);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->fullname);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->role_id);
                        $doc->exportField($this->_token);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->last_login);
                        $doc->exportField($this->is_verified);
                        $doc->exportField($this->location);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
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
