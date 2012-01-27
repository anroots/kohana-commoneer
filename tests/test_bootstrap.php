<?

function reset_database() {
    exec('mysql -u unittest -ptestcase unittest < tests/fixtures/structure.sql');
}

define('SUPPRESS_REQUEST', TRUE);

//reset_database();

require('../../../index.php');

if (!method_exists(Request::current(), 'is_ajax')) {
    Request::$current = Request::factory('');
}
