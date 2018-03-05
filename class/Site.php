<?php
//namespace DB\Utils;
use \DB\SQL\Schema;

class Site 
{

    /** @var \DB\SQL */
    protected $db;

    /** @var \BASE */
    protected $f3;

    function __construct()
    {
        $this->f3 = \Base::instance();
        //$this->db = parent::__construct($db);
    }

    static function databaseReady($schema, $driver= 'mysql', $port = '3306', $hostname = 'localhost', $username ='root', $password = '') {
        // Create connection
        // NOTE: Use PDO instead of vendor specific instances like mysqli_connect() or oci_connect()

        try {
            $conn = new PDO("{$driver}:host={$hostname};port={$port}", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully<br>";
                        
            $sql = "CREATE DATABASE IF NOT EXISTS {$schema}";
            
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "Database ready<br>";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage() . "<br>";    
            return false;
        }
        finally {
            $conn = null;
        }
        return true;
    }
    
    
    static function schemaReady($f3) {
        //Get the base tables from the F3 config
        $tables = $f3->get('schema.tables');
        //For each table that is enabled (TRUE) in the config then create its table in the DB using the f3-schema-builder API
        //TODO: Test if this drops or alters tables
        $db = $f3->get('DB');
        $schema = new \DB\SQL\Schema( $db );
        foreach ($tables as $key => $value)
            if ($value == true && !in_array($key,$schema->getTables()))
            {
                $createtable = 'Create' . ucfirst($key) .'Table'; 
                \Site::$createtable($f3);
            }
        return true;
    }
    
    static function CreateUserTable($f3) {
        //https://github.com/ikkez/f3-schema-builder
        $db = $f3->get('DB');
        $prefix = $f3->get('schema.prefix');
        $schema = new \DB\SQL\Schema( $db );
        $table = $schema->createTable($prefix . "user");
        $table->addColumn('name')->type(Schema::DT_VARCHAR128)->nullable(false);
        $table->addColumn('mail')->type(Schema::DT_VARCHAR128)->nullable(false);
        $table->addColumn('pass')->type(Schema::DT_VARCHAR128)->nullable(false);
        $table->addColumn('created')->type(Schema::DT_INT4)->nullable(false);
        $table->addColumn('access')->type(Schema::DT_INT4);
        $table->addColumn('login')->type(Schema::DT_INT4);
        $table->addColumn('status')->type(Schema::DT_BOOLEAN)->nullable(false)->defaults(0);
        $table->primary(array('id', 'mail'));
        $table->build();
        echo 'Created user table <br>';
    }
    static function CreateNodeTable($f3) {
        //https://github.com/ikkez/f3-schema-builder
        $db = $f3->get('DB');
        $prefix = $f3->get('schema.prefix');
        $schema = new \DB\SQL\Schema( $db );
        $table = $schema->createTable($prefix . "node");
        $table->addColumn('type')->type(Schema::DT_VARCHAR128)->nullable(false);
        $table->addColumn('title')->type(Schema::DT_VARCHAR256)->nullable(false);
        $table->addColumn('uid')->type(Schema::DT_INT4)->nullable(false);
        $table->addColumn('status')->type(Schema::DT_BOOLEAN)->nullable(false)->defaults(0);
        $table->addColumn('created')->type(Schema::DT_INT4)->nullable(false);
        $table->addColumn('changed')->type(Schema::DT_INT4);
        $table->addColumn('sticky')->type(Schema::DT_INT4);
        $table->primary(array('id'));
        $table->build();
        echo 'Created node table <br>';
    }
}