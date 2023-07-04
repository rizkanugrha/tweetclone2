<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('asset/images/twitter.svg');?>">
    <title>TC - Twitter Clone</title>
    <?= link_tag('asset/css/bootstrap.min.css') ?>
    <?= link_tag('asset/css/style.css') ?>
    <?= link_tag('asset/css/bootstrap.css') ?>
    <?= link_tag('asset/css/font-awesome.css') ?>
    <?= link_tag('asset/css/font-awesome.min.css') ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'/>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-ligt" 
            style="background-color: #e3f2fd;">  
            <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <?=img(['src'=>'asset/images/twitter.svg', 'width'=>30, 'height'=>24])?>                
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">                
                <strong><a class="nav-link" href="<?=base_url('/')?>">(TC) Twitter Clone</a></strong>
            </div>
            </div>
        </nav>