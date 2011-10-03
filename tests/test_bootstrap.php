<?

function reset_database() {
    exec('mysql -u unittest -ptestcase unittest < fixtures/structure.sql');
}

define('SUPPRESS_REQUEST', TRUE);

//reset_database();

require('../../index.php');

