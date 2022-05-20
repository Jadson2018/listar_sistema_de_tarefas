<?php
$ Servername = "localhost";
$ Username = "root";
$ Password = "";
$ Dbname = "baselistar";

// Criar uma ligação
$Conn = new mysqli ($Servername, $Username, $Password, $Dbname);
// Teste de conexão
if ($conn-> connect_error) {
Die ( "A ligação falhou:" $conn->connect_error.);
}

// Cria uma tabela de dados usando sql
$Sql= "CREATE TABLE Tarefas (
id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR (30) NOT NULL,
custo DOUBLE NOT NULL,
datalimite TIMESTAMP,
ordem INT,
usuario INT
) ALTER TABLE tarefas ADD FOREIGN KEY (usuario) REFERENCES usuarios(id)";

if ($ conn-> query ($ sql) === TRUE) {
echo "MyGuests tabela criada com sucesso";
} Else {
echo "Criar um erro de tabela de dados:" $ conn-> erro ;.
}

$ Conn-> close ();
