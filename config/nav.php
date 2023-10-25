<?php
return [
[
    'icon'=>'nav-icon fas fa-tachometer-alt',
    'route'=>'dashboard.dashboard',
    'title'=>'Dashboard',
    'active'=>'dashboard.dashboard'
],
[
    'icon'=>'far fa-circle nav-icon',
    'route'=>'dashboard.category.index',
    'title'=>'categories',
    'badge'=>'new',
    'active'=>'dashboard.category.*'
],
[
    'icon'=>'far fa-circle nav-icon',
    'route'=>'dashboard.products.index',
    'title'=>'products',
    'active'=>'dashboard.products.*'
],
[
    'icon'=>'far fa-circle nav-icon',
    'route'=>'dashboard.category.index',
    'title'=>'Orders',
    'active'=>'dashboard.orders.*'
]
];


