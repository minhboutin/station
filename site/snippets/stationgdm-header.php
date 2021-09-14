<!DOCTYPE html>
<html lang="en">
<head><?php $stationgdm = $site->children()->find('stationgdm') ;
            $programmes = $stationgdm->children()->find('programmes') ;
            $agenda = $stationgdm->children()->find('agenda') ;
            $journal = $stationgdm->children()->find('journal') ;
            $billetterie = $stationgdm->children()->find('billetterie') ;
            $informations = $stationgdm->children()->find('informations') ;
?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $stationgdm->title() ?> • <?= $page->title() ?></title>

  <?= css([
    'assets/css/stationgdm.css',
    '@auto'
  ]) ?>

  <link rel="icon" href="http://lastation.paris/wp-content/uploads/2020/09/cropped-station-nord-sud-fav--32x32.png" sizes="32x32" />
  <link rel="icon" href="http://lastation.paris/wp-content/uploads/2020/09/cropped-station-nord-sud-fav--192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon" href="http://lastation.paris/wp-content/uploads/2020/09/cropped-station-nord-sud-fav--180x180.png" />
  <meta name="msapplication-TileImage" content="http://lastation.paris/wp-content/uploads/2020/09/cropped-station-nord-sud-fav--270x270.png" />

  <link rel="shortcut icon" type="image/x-icon" href="">
</head>
<body>

  <div id="frame"></div>

  <header id="header">
    <div id="logo">
      <a href="<?= $stationgdm->url() ?>" class="logo">
        <div id="logo-shape">
          <div id="logo-circle"></div>
        </div>
        <div id="logo-type">
        </div>
      </a>
    </div>
    <nav class="small cap bold">
      <ul id="menu" class="menu">
        <li class="menu-button">
          <a id="programmes" <?php if(strpos($page->url(), 'programmes') !== false) { echo 'class="active"' ; } ?>><?= $programmes->title() ?></a>
        </li>
        <?php foreach ($programmes->children()->listed() as $item): ?><li class="submenu-mobile programmes">
          <a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>">
            <?= $item->title()->html() ?>
          </a>
        </li><?php endforeach ?>
        <li class="menu-button">
          <a href="<?= $agenda->url() ?>" <?php if(strpos($page->url(), 'agenda') !== false || strpos($page->url(), 'rendez-vous') !== false || strpos($page->url(), 'temps-forts') !== false ) { echo 'class="active"' ; } ?>><?= $agenda->title() ?></a>
        </li>
        <li class="menu-button">
          <a href="<?= $journal->url() ?>" <?php if(strpos($page->url(), 'journal') !== false) { echo 'class="active"' ; } ?>><?= $journal->title() ?></a>
        </li>
        <li class="menu-button">
          <a href="<?= $billetterie->url() ?>" <?php if(strpos($page->url(), 'billetterie') !== false) { echo 'class="active"' ; } ?>><?= $billetterie->title() ?></a>
        </li>
        <li class="menu-button">
          <a id="informations" <?php if(strpos($page->url(), 'informations') !== false) { echo 'class="active"' ; } ?>><?= $informations->title() ?></a>
        </li>
        <?php foreach ($informations->children()->listed() as $item): ?><li class="submenu-mobile informations">
          <a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>">
            <?= $item->title()->html() ?>
          </a>
        </li><?php endforeach ?>
        <li id="search-bar" class="search">
          <a id="picto-search">
            <img src="<?= $site->url() ?>/assets/pictos/search-black.svg">
          </a>
          <div id="search-input">
            <form action="<?= $stationgdm->url() ?>/search" autocomplete="off">
              <input id="search" type="text" name="q" value="" class="medium bold cap" placeholder="Recherche" autocomplete="off" required>
            </form>
          </div>
          <div id="close-search">
            <img id="close" src="<?= $site->url() ?>/assets/pictos/cross-black.svg">
          </div>
        </li>
        <li id="menu-separator">
        </li>
        <li class="button-search-mobile">
          <a id="button-search-mobile">Rechercher</a>
        </li>
        <a id="radio" class="stationstation" href="http://stationstation.fr/" target="_blank">
          <li id="button-radio" class="link">
            Station Station
          </li>
          <li class="radio">
            <div id="picto-radio"></div>
          </li>
        </a>
        <li class="button-radio-mobile">
          <a class="stationstation" href="http://stationstation.fr/" target="_blank">
            Station Station
          </a>
        </li>
      </ul>
      <ul class="submenu">
        <ul id="submenu-programmes">
          <?php foreach ($programmes->children()->listed() as $item):
          ?><a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>"><li>
            <?= $item->title()->html() ?>
            </li>
          </a>
        <?php endforeach 
        ?></ul>
        <ul id="submenu-informations">
          <?php foreach ($informations->children()->listed() as $item):
          ?><a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>">
            <li>
              <?= $item->title()->html() ?>
            </li>            
          </a>
        <?php endforeach 
        ?></ul>
      </ul>
      <div id="button-menu-mobile" class="button-menu-mobile small">
        <a >Menu</a>
      </div>
      <div id="button-close-menu-mobile" class="button-close-menu-mobile small">
        <div class="close"></div>
      </div>
    </nav>
  </header>
  
  <div id="menu-reduced" class="white">
    <div class="menu">
      <div id="logo-reduced">
        <a href="<?= $stationgdm->url() ?>" class="logo">
          <div id="logo-shape-reduced">
            <div id="logo-circle-reduced"></div>
          </div>
        </a>
      </div>

      <nav class="small cap bold">
        <ul id="menu" class="menu">
          <li class="menu-button">
            <a id="programmes-reduced"><?= $programmes->title() ?></a>
          </li>
          <li class="menu-button">
            <a href="<?= $agenda->url() ?>"><?= $agenda->title() ?></a>
          </li>
          <li class="menu-button">
            <a href="<?= $journal->url() ?>"><?= $journal->title() ?></a>
          </li>
          <li class="menu-button">
            <a href="<?= $billetterie->url() ?>"><?= $billetterie->title() ?></a>
          </li>
          <li class="menu-button">
            <a id="informations-reduced"><?= $informations->title() ?></a>
          </li>
          <li id="search-bar-reduced" class="search">
            <a id="picto-search-reduced">
              <img src="<?= $site->url() ?>/assets/pictos/search-black.svg">
            </a>
            <div id="search-input-reduced">
              <form action="<?= $stationgdm->url() ?>/search" autocomplete="off">
                <input id="search-reduced" type="text" name="q" value="" class="medium bold cap" placeholder="Recherche" autocomplete="off" required>
              </form>
            </div>
            <div id="close-search-reduced">
              <img id="close-reduced" src="<?= $site->url() ?>/assets/pictos/cross-black.svg">
            </div>
          </li>
          <li id="menu-separator-reduced">
          </li>
          <a id="radio-reduced" class="stationstation" href="http://stationstation.fr/" target="_blank">
            <li class="radio">
              <div id="picto-radio-reduced"></div>
            </li>
          </a>
        </ul>
      </nav>
    </div>
    <div id="submenu-reduced">
      <nav class="small cap bold">
        <ul class="submenu">
          <ul id="submenu-reduced-programmes">
            <?php foreach ($programmes->children()->listed() as $item):
            ?><a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>"><li>
              <?= $item->title()->html() ?>
              </li>
            </a>
          <?php endforeach 
          ?></ul>
          <ul id="submenu-reduced-informations">
            <?php foreach ($informations->children()->listed() as $item):
            ?><a <?php e($item->isOpen(), 'aria-current ') ?> href="<?= $item->url() ?>">
              <li>
                <?= $item->title()->html() ?>
              </li>            
            </a>
          <?php endforeach 
          ?></ul>
        </ul>
      </nav>
    </div>
  </div>

  <div id="open-mobile-search" class="mobile-search">
    <form action="<?= $stationgdm->url() ?>/search" autocomplete="off">
      <input id="mobile-search" type="text" name="q" value="" class="medium bold cap" placeholder="Que cherchez-vous ?" autocomplete="off" required>
    </form>
  </div>

  <div id="button-close-search-mobile" class="button-close-search-mobile">
    <div class="close"></div>
  </div>

  <main class="main">