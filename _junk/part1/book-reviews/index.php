<h1> Book Reviews List </h1>

<table class="table table-striped">

	<tr>
		<th>Book Title</th>
		<th>Author</th>
		<th>Action</th>
	</tr>	

	<?php
	foreach ($booksList as $book) {
		$id = $book['id'];
	?>
	<tr>
		<td><?= $book['book_title'] ?></td>
		<td><?= $book['author'] ?></td>
		<td><a href="/book-reviews/view?id=<?= $id ?>">
			<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
			View</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>