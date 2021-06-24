<?php


class QueryBuilder 
{
	public $pdo;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function selectAll($table, $intoClass)
	{

		$statement = $this->pdo->prepare("select * from {$table}");

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
	}

	public function whereEmail($email)
	{
		$sql = "SELECT * FROM users WHERE email= :email"; // SQL with parameters
		$statement = $this->pdo->prepare($sql); 
		$statement->execute(['email' => $email]);

		return $statement->fetchAll(PDO::FETCH_CLASS, User::class);
	}

	public function delete($movie_id, $table)
	{
		$sql = "DELETE FROM {$table} WHERE movie_id= :movie_id"; // SQL with parameters
		$statement = $this->pdo->prepare($sql); 
		$statement->execute(['movie_id' => $movie_id]);

	}

	public function create($data, $table)
	{
		$sql = sprintf(
			'insert into %s (%s) values (%s)',
			$table,
			implode(',', array_keys($data)),
			':'.implode(', :', array_keys($data))
		);

		try {
			$statement = $this->pdo->prepare($sql);

			$statement->execute($data);
		} catch (Exception $e) {
			
			die('Whoops something went wrong');
		}
				
	}
}