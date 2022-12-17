<?php

class ExpenseManager {
  private $conn;

  public function __construct($mysql_server, $mysql_username, $mysql_password, $mysql_db) {
    $this->conn = new mysqli($mysql_server, $mysql_username, $mysql_password, $mysql_db);
  }

  public function addExpense($amount, $category, $description) {
    $stmt = $this->conn->prepare("INSERT INTO expenses (amount, category, description) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $amount, $category, $description);
    $stmt->execute();
  }

  public function addIncome($amount, $category, $description) {
    $stmt = $this->conn->prepare("INSERT INTO income (amount, category, description) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $amount, $category, $description);
    $stmt->execute();
  }

  public function getTotalExpenses() {
    $result = $this->conn->query("SELECT SUM(amount) as total FROM expenses");
    $row = $result->fetch_assoc();
    return $row['total'];
  }

  public function getTotalIncome() {
    $result = $this->conn->query("SELECT SUM(amount) as total FROM income");
    $row = $result->fetch_assoc();
    return $row['total'];
  }

  public function getExpenseReport($start_date, $end_date) {
    $stmt = $this->conn->prepare("SELECT * FROM expenses WHERE date BETWEEN ? AND ?");
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    return $stmt->get_result();
  }

  public function getIncomeReport($start_date, $end_date) {
    $stmt = $this->conn->prepare("SELECT * FROM income WHERE date BETWEEN ? AND ?");
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    return $stmt->get_result();
  }
}

?>
