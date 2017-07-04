<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BookReviewsController extends Controller
{
	public function actionIndex()
	{
		//every books reviewed is gonna have id, title, author, url etc		
/*
		$count = 0;
		foreach ($data['booksList'] as $book) {
			$count++;
			$var_type=gettype($book);
			echo "book ".$count." is an ".$var_type."<br><br>";
		}
*/
		$data['booksList'] = $this->actionGetBooksList();
		return $this->render('index', $data);

	}

	public function actionView($id)
	{

		$data['id'] = $id;
		$booksList = $this->actionGetBooksList();
		foreach ($booksList as $book) {
			if ($id==$book['id']) {
				//this is the targeted book
				$data['book_title'] = $book['book_title'];
				$data['author'] = $book['author'];
				$data['amazon_url'] = $book['amazon_url'];
			}
		}
		return $this -> render('view', $data);

	}

	public function actionGetBooksList()
	{

		$booksList = [
			['id'=>1,'book_title' => 'The Power of Now', 'author' => 'Eckhart', 'amazon_url' => 'www.amazon.com'],
			['id'=>2,'book_title' => 'Slaying the Dragon', 'author' => 'Michael Johnson', 'amazon_url' => 'www.amazon.com'],
			['id'=>3,'book_title' => 'Business at the Speed of thought', 'author' => 'Bill Gates', 'amazon_url' => 'www.amazon.com']
		];

		return $booksList;

	}

/*
	public function actionIndex()
	{
		//nampilin page hello.php dari view dlm folder book-review yang meng-echo "hello from the book reviews controller ";
		//Flow of data: Controller > template > view
		$data['name'] = "the name :v";
		$data['age'] = "over 21";
		$data['city'] = "here";
		return $this -> render('hello', $data);
	}

	public function actionAnotherPage()
	{
		// nampilin template "alt_layout.php" 
		$this->layout = "alt_layout";
		$data['name'] = "the name is Me";
		$data['age'] = "over 9000";
		$data['city'] = "here";
		return $this -> render('hello', $data);
	}
*/

}
