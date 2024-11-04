<?php
require_once "config.php";
require_once "check_login.php";
include 'Nav.php';

$current_date = date('Y-m-d');

// algorithm used: linear-searching for product, sorting or displaying

$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'start_date';
$order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'ASC' : 'DESC';

$sql = "SELECT * FROM auction_items WHERE approved = 1 AND end_date >= '$current_date'";

if ($category_filter != 'all') {
    $sql .= " AND category = '" . mysqli_real_escape_string($link, $category_filter) . "'";
}

if (!empty($search_query)) {
    $sql .= " AND name LIKE '%" . mysqli_real_escape_string($link, $search_query) . "%'";
}
$sql .= " ORDER BY " . mysqli_real_escape_string($link, $sort_by) . " $order";


$result = mysqli_query($link, $sql);

$items = [];
$categories = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
        $categories[] = $row['category'];
    }
    $categories = array_unique($categories); // Get unique categories
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction</title>

    <link rel="stylesheet" href="../Style.css">
    <style>
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            transform: translateY(-5px);
        }

        .info {
            padding: 10px;
            text-align: center;
        }

        .btn-custom {
            background-color: #2d6a4f;
            color: white;
        }

        .btn-custom:hover {
            background-color: #1b4332;
        }
    </style>
</head>

<body> <br><br>
    <div class="container mt-6">
        <div class="row mb-3">
            <!-- Dropdown on the left -->
            <div class="col-md-4">
                <form method="get" action="">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="all" <?= ($category_filter == 'all') ? 'selected' : '' ?>>All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category); ?>" <?= ($category_filter == $category) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
            </div>

            <!-- Search bar on the right -->
            <div class="col-md-4 text-end">
                <input type="text" name="search" class="form-control" placeholder="Search items"
                    value="<?= htmlspecialchars($search_query); ?>" onblur="this.form.submit()">
            </div>

            <!-- Sort options -->
            <div class="col-md-4">
                <select name="sort_by" class="form-select" onchange="this.form.submit()">
                    <option value="start_date" <?= ($sort_by == 'start_date') ? 'selected' : '' ?>>Start Date</option>
                    <option value="name" <?= ($sort_by == 'name') ? 'selected' : '' ?>>Name</option>
                    <option value="initial_bid" <?= ($sort_by == 'initial_bid') ? 'selected' : '' ?>>Initial Bid</option>
                </select>
            </div>
            <input type="hidden" name="order" value="<?= ($order == 'ASC') ? 'desc' : 'asc' ?>">
            </form>
        </div>

        <div class="row" id="gallery">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="col-md-4 mb-4 gallery-item">
                        <div class="gallery-item-inner">
                            <img src="<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>"
                                class="img-fluid">
                            <div class="info">
                                <h5>Name: <?= htmlspecialchars($item['name']); ?></h5>
                                <a href="item_details.php?id=<?= htmlspecialchars($item['A_id']); ?>"
                                    class="btn btn-custom mt-2">See More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No items found for your criteria.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>