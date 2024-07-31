<?php 
  include "../config/db.php";
  include "../insertStock/insertStockHandler.php";

  $totalBlockA = count(getBlockAinfo());
  $totalBlockB = count(getBlockBinfo());
  $totalBlockC = count(getBlockCinfo());

  $blockA = getBlockAinfo();
  //var_dump($blockA);
  $blockB = getBlockBinfo();
  $blockC = getBlockCinfo();
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>In Stock</title>
    <link rel="stylesheet" href="../css/InStock.css" />
  </head>
  <body>
    <header class="header">
      <button class="header-option-btn" id="toggle-sidebar-btn">
        <img src="../images/nav.png" alt="Options" class="button-icon" />
      </button>
      <button class="header-avatar-btn" id="avatar-btn">
        <img src="../images/avatar.png" alt="Avatar" class="avatar-icon" />
      </button>
    </header>
    <div class="main-container">
      <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
          <li>
            <a href="../Dashboard.php" id="dashboard-btn"
              ><img
                src="../images/Home.png"
                alt="Dashboard Icon"
                class="menu-icon"
              /><span>Dashboard</span></a
            >
          </li>
          <li>
            <a href="../insertStock/InStock.php" id="instock-btn"
              ><img
                src="../images/InStock_Icon.png"
                alt="Insotck Icon"
                class="menu-icon"
              /><span>In Stock</span></a
            >
          </li>
          <li>
            <a href="../pick/Pick.php" id="pick-btn"
              ><img
                src="../images/list.png"
                alt="Pick Icon"
                class="menu-icon"
              /><span>Pick</span></a
            >
          </li>
          <li>
            <a href="../return/Return.php" id="dashboard-btn"
              ><img
                src="../images/stockReturn.png"
                alt="Return Icon"
                class="menu-icon"
              /><span>Return</span></a
            >
          </li>
        </ul>
        <ul class="sidebar-bottom-menu">
          <li>
            <a href="#settings"
              ><img
                src="../images/Setting.png"
                alt="Settings Icon"
                class="menu-icon"
              /><span>Settings</span></a
            >
          </li>
          <li>
            <a href="#logout" id="logout-btn"
              ><img
                src="../images/logOut.png"
                alt="Log Out Icon"
                class="menu-icon"
              /><span>Log Out</span></a
            >
          </li>
        </ul>
      </aside>
      <div class="content" id="content">
        <button class="block-button" id="blockA">Block A</button>
        <button class="block-button" id="blockB">Block B</button>
        <button class="block-button" id="blockC">Block C</button>

        <div id="blockAInfo" class="block-info features" name="block_A" style="display: none">
          <div class="block-header">
            <p id="inStockText">In Stock</p>
            <div class="button-container">
              <a href="../InsertStock.php">
                <button id="newStockButton" onclick="redirectToInsertStock()">
                  New Stock
                </button>
              </a>
              
              <button id="pickStockButton">Pick Stock</button>
            </div>
          </div>
          <hr />
          <div class="features">
            <!-- <div class="search-box">
              <input
                type="text"
                id="searchInput"
                placeholder="Quick search..."
              />
              <img
                src="../images/icon/search_Icon.png"
                alt="Search Icon"
                class="search-icon"
              />
            </div> -->
            <div class="total-box">TOTAL:    <?= $totalBlockA; ?></div>
            <!-- <div style="position: relative; display: inline-block">
              <input type="date" id="datePicker" style="display: none" />
              <button class="date-picker-button" id="datePickerButton">
                &#128197;
              </button>
            </div> -->
            <!-- <div class="dropdown-container">
              <select id="statusDropdown"></select>
            </div> -->
          </div>
          <hr />
          <div class="shipment-details">
            <!-- <div class="shipment-column"><input type="checkbox" /></div> -->
            <div class="shipment-column">Package ID</div>
            <div class="shipment-column">Barcode</div>
            <div class="shipment-column">Category</div>
            <div class="shipment-column">Name</div>
            <div class="shipment-column">Bin Location</div>
            <div class="shipment-column">Status</div>
          </div>
          <hr />
          <?php foreach($blockA as $packageA){ ?>
            <div class="shipment-details">
            <!-- <div class="shipment-column"><input type="checkbox" /></div> -->
            <div class="shipment-column"><?= $packageA['id'] ?></div>
            <div class="shipment-column"><?= $packageA['bar_code'] ?></div>
            <div class="shipment-column"><?= $packageA['category'] ?></div>
            <div class="shipment-column"><?= $packageA['package_name'] ?></div>
            <div class="shipment-column"><?= $packageA['bin_location'] ?></div>
            <div class="shipment-column"><?= $packageA['status'] ?></div>
          </div>
            <?php }?>
        </div>

        <div id="blockBInfo" class="block-info features" name="block_B" style="display: none">
          <div class="block-header">
            <p id="inStockText">In Stock</p>
            <div class="button-container">
              <button id="newStockButton" onclick="redirectToInsertStock()">
                New Stock
              </button>
              <button id="pickStockButton">Pick Stock</button>
            </div>
          </div>
          <hr />
          <div class="features">
            <!-- <div class="search-box">
              <input
                type="text"
                id="searchInput"
                placeholder="Quick search..."
              />
              <img
                src="../images/icon/search_Icon.png"
                alt="Search Icon"
                class="search-icon"
              />
            </div> -->
            <div class="total-box">TOTAL:   <?= $totalBlockB ?></div>
            <!-- <div style="position: relative; display: inline-block">
              <input type="date" id="datePicker" style="display: none" />
              <button class="date-picker-button" id="datePickerButton">
                &#128197;
              </button>
            </div>
            <div class="dropdown-container">
              <select id="statusDropdown"></select>
            </div> -->
          </div>
          <hr />
          <div class="shipment-details">
            <div class="shipment-column">Shipment ID</div>
            <div class="shipment-column">Barcode</div>
            <div class="shipment-column">Category</div>
            <div class="shipment-column">Name</div>
            <div class="shipment-column">Bin Location</div>
            <div class="shipment-column">Status</div>
            
          </div>
          <hr />
          <?php foreach($blockB as $packageB){ ?>
            <div class="shipment-details">
            <!-- <div class="shipment-column"><input type="checkbox" /></div> -->
            <div class="shipment-column"><?= $packageB['id'] ?></div>
            <div class="shipment-column"><?= $packageB['bar_code'] ?></div>
            <div class="shipment-column"><?= $packageB['category'] ?></div>
            <div class="shipment-column"><?= $packageB['package_name'] ?></div>
            <div class="shipment-column"><?= $packageB['bin_location'] ?></div>
            <div class="shipment-column"><?= $packageB['status'] ?></div>
          </div>
            <?php }?>
        </div>

        <div id="blockCInfo" class="block-info features" name="block_C" style="display: none">
          <div class="block-header">
            <p id="inStockText">In Stock</p>
            <div class="button-container">
              <button id="newStockButton" onclick="redirectToInsertStock()">
                New Stock
              </button>
              <button id="pickStockButton">Pick Stock</button>
            </div>
          </div>
          <hr />
          <div class="features">
            <!-- <div class="search-box">
              <input
                type="text"
                id="searchInput"
                placeholder="Quick search..."
              />
              <img
                src="../images/icon/search_Icon.png"
                alt="Search Icon"
                class="search-icon"
              />
            </div> -->
            <div class="total-box">TOTAL:   <?= $totalBlockC ?></div>
            <!-- <div style="position: relative; display: inline-block">
              <input type="date" id="datePicker" style="display: none" />
              <button class="date-picker-button" id="datePickerButton">
                &#128197;
              </button>
            </div> -->
            <!-- <div class="dropdown-container">
              <select id="statusDropdown"></select>
            </div> -->
          </div>
          <hr />
          <div class="shipment-details">
            <div class="shipment-column">Shipment ID3</div>
            <div class="shipment-column">Barcode</div>
            <div class="shipment-column">Category</div>
            <div class="shipment-column">Name</div>
            <div class="shipment-column">Bin Location</div>
            <div class="shipment-column">Status</div>
          </div>
          <hr />
          <?php foreach($blockC as $packageC){ ?>
            <div class="shipment-details">
            <!-- <div class="shipment-column"><input type="checkbox" /></div> -->
            <div class="shipment-column"><?= $packageC['id'] ?></div>
            <div class="shipment-column"><?= $packageC['bar_code'] ?></div>
            <div class="shipment-column"><?= $packageC['category'] ?></div>
            <div class="shipment-column"><?= $packageC['package_name'] ?></div>
            <div class="shipment-column"><?= $packageC['bin_location'] ?></div>
            <div class="shipment-column"><?= $packageC['status'] ?></div>
          </div>
            <?php }?>
        </div>
      </div>
    </div>
    <script src="../javascript/InStock.js"></script>
    <script src="../javascript/Head_Side.js"></script>
  </body>
</html>
