<?php
/**
 *
 */
require_once '../models/db.php';

class Model
{
  protected $fillable = [];

  public function __construct()
  {
    $this->pdo = $GLOBALS['pdo'];
  }

  public function searchById($id)
  {
    SELECT * FROM $this->table WHERE id = $id;
    $this->email = 'aaferyat@gmail.com';
    $this->user = 'Aharone';
    $this->id = '1';

  }

  public function save()
  {
    if isset $this-id
      $this->update
    else
      $this->create
  }

  public function delete($id)


  private function udpate()
  {
    $fields = [];
    foreach ($this->fillable as $value) {
      $fields[] = $value . '=' . $this->$value;
    }
    $query = 'UPDATE ' . $this->table . ' SET ' . implode(',', $fields) . ' WHERE id = ' . $this->id;
    $this->pdo->execute($query);
  }

  private function create()
  {

  }
}
