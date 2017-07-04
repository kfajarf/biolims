<?php 
	$this->params['breadcrumbs'][] = ['label'=>'Book Reviews', 'url' => '/book-reviews'];
	$this->params['breadcrumbs'][] = $book_title;
?>

<h1>Review for Book Id <?= $id ?> </h1>

<table class="table table-striped table-bordered">

	<tr>
		<td>Book Title</td>
		<td><?= $book_title ?></td>
	</tr>
	<tr>
		<td>Author</td>
		<td><?= $author ?></td>
	</tr>
	<tr>
		<td>Url</td>
		<td><?= $amazon_url ?></td>
	</tr>

</table>
<?php 
	//$data['yourName'] = "Mee";
	//echo $this->render('_advert', $data); or
?>
<?= $this->render('_advert') ?>