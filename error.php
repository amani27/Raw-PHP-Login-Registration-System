<?php include('server.php'); ?>
<?php if (count($errors) > 0) : ?>

    <?php foreach ($errors as $i) : ?>
        <p style:'color:red'> <?php echo $i; ?> </p>
    <?php endforeach ?>

<?php endif ?>