<?php

namespace Repository{

    use Entity\TodoList;

    interface TodoListRepository
    {
        function save(TodoList $todoList): void;

        function remove(int $number): bool;

        function findALL(): array;

    }

    class TodoListRepositoryImpl implements TodoListRepository{
        
        public array $todoList = array();

        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }

        function save(TodoList $todoList): void
        {
            // $number = sizeof($this->todoList) + 1;
            // $this->todoList[$number] = $todoList;

            $sql = "INSERT INTO todolist(todo) VALUES (?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$todoList->getTodo()]); 
        }

        function remove(int $number): bool
        {
            $sql = "SELECT id FROM todolist WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                //todo list ada
                $sql = "DELETE FROM todolist WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return true;
            } else {
                //todo list tidak ada
                return false;
            }
            
        }

        function findAll(): array
        {
            // return $this->todoList;
            $sql="SELECT id, todo FROM todolist";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = [];

            foreach ($statement as $row) {
                $todoList = new TodoList ();
                $todoList->setId($row['id']); //mengambil id
                $todoList->setTodo($row['todo']); // mengambil todo

                $result[] = $todoList;
            }
            // array of data objek
            return $result;
        }
    }
}