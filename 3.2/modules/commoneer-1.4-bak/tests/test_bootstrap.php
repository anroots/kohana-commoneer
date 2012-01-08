<?

function reset_database() {
    exec('mysql -u unittest -ptestcase unittest < tests/fixtures/structure.sql');
}

define('SUPPRESS_REQUEST', TRUE);

//reset_database();

require('../../../index.php');

