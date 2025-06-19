<?php

require_once './core/Database.php';
require_once './model/Usuario.php';

class UsuarioDAO
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    // CREATE
    public function create(Usuario $usuario): bool
    {
        $sql = "INSERT INTO usuario (nome, email, senha, token) VALUES (:nome, :email, :senha, :token)";
        $stmt = $this->db->prepare($sql);

        $senhaHash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        return $stmt->execute([
            ':nome' => $usuario->getNome(),
            ':email' => $usuario->getEmail(),
            ':senha' => $senhaHash,
            ':token' => $usuario->getToken()
        ]);
    }
    // READ (Todos os usuários)
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT id, nome, email FROM usuario");
        $usuarioData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuario = [];
        foreach ($usuarioData as $data) {
            // O token e a senha não são necessários para a exibição em getAll
            $usuario[] = new Usuario($data['id'], $data['nome'], $data['email'], '', null);
        }
        return $usuario;
    }

    // READ (Por ID)
    public function getById(int $id): ?Usuario
    {
        $stmt = $this->db->prepare("SELECT id, nome, email, senha, token FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Usuario($data['id'], $data['nome'], $data['email'], $data['senha'], $data['token']);
        }
        return null;
    }
    // READ
    public function getByToken(string $token): ?Usuario
    {
        $stmt = $this->db->prepare("SELECT id, nome, email, senha, token FROM usuario WHERE token = :token");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Usuario($data['id'], $data['nome'], $data['email'], $data['senha'], $data['token']);
        }
        return null;
    }
    // READ (Por Email, útil para login e evitar duplicidade)
    public function getByEmail(string $email): ?Usuario
    {
        $stmt = $this->db->prepare("SELECT id, nome, email, senha, token FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Usuario($data['id'], $data['nome'], $data['email'], $data['senha'], $data['token']);
        }
        return null;
    }
    // UPDATE
    public function update(Usuario $usuario): bool
    {
        $sql = "UPDATE usuario SET nome = :nome, email = :email";
        $params = [
            ':nome' => $usuario->getNome(),
            ':email' => $usuario->getEmail(),
            ':id' => $usuario->getId()
        ];
        // Se a senha foi alterada, atualize-a também
        if (!empty($usuario->getSenha())) {
            $sql .= ", senha = :senha";
            $params[':senha'] = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute($params);
    }
    public function updateToken (int $id, ?string $token): bool {
        $sql = 'UPDATE usuario SET token = :token WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':token'=> $token,
            ':id'=> $id
            ]
        );
    }

    public function setToken(?string $token): void { 
        $this->token = $token; 
    }
    // DELETE
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}