<?php
// search controller

// create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/search-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';


// get the array of classifications from DB using model
$classifications = getClassifications();

// build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == null) {
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
    case 'search':
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $searchResults = performSearch($search);

        if (empty($search)) {
            $message = "<p>Error: You must provide a search string!</p>";
        } else {
            // pagination logic
            $totalResults = count($searchResults);
            $resultsPerPage = 10;
            $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
            $offset = ($currentPage - 1) * $resultsPerPage;

            // get results for the current page
            $paginatedResults = array_slice($searchResults, $offset, $resultsPerPage);

            if (empty($paginatedResults)) {
                $num = "<p>Sorry, no results were found. Try again!</p>";
            } else {
                $searchDisplay = buildSearchResults($paginatedResults);
                $num = "Showing results " . ($offset + 1) . " to " . min(($offset + $resultsPerPage), $totalResults) . " out of $totalResults (Page $currentPage)";

                // calculate total pages for pagination
                $totalPages = ceil($totalResults / $resultsPerPage);

                // generate pagination bar
                $paginationBar = generatePaginationBar($currentPage, $totalPages, $search);
            }
        }

        include '../view/search.php';
        break;

    default:
        // default view
        include '../view/search.php';
        break;
}

?>