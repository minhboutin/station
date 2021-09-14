<?php

return function ($site) {

  $query   = get('q');
  $results = page('stationgdm')->children()->find('programmes', 'temps-forts', 'rendez-vous', 'journal', 'informations', 'pages')->children()->listed()->search($query, 'title|text|mainlabels|maintags|mainthemes');
  $results = $results->paginate(16);

  return [
    'query'      => $query,
    'results'    => $results,
    'pagination' => $results->pagination()
  ];

};