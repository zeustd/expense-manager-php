<?php
include('ExpenseManager.php');

// Connect to the MySQL database
$expense_manager = new ExpenseManager("localhost", "mysql_username", "mysql_password", "mysql_db");

// Add a new expense
$expense_manager->addExpense(100, "food", "Groceries for the week");

// Add a new income
$expense_manager->addIncome(2000, "salary", "Paycheck for December");

// Get the total expenses
$total_expenses = $expense_manager->getTotalExpenses();
echo "Total expenses: $total_expenses\n";

// Get the total income
$total_income = $expense_manager->getTotalIncome();
echo "Total income: $total_income\n";

// Get the expense report for the current month
$start_date = date("Y-m-01"); // first day of the current month
$end_date = date("Y-m-t"); // last day of the current month
$expense_report = $expense_manager->getExpenseReport($start_date, $end_date);

echo "Expense report:\n";
while ($row = $expense_report->fetch_assoc()) {
  echo "  Expense ID: " . $row['id'] . "\n";
  echo "  Amount: " . $row['amount'] . "\n";
  echo "  Category: " . $row['category'] . "\n";
  echo "  Description: " . $row['description'] . "\n";
  echo "  Date: " . $row['date'] . "\n";
}

// Get the income report for the current month
$income_report = $expense_manager->getIncomeReport($start_date, $end_date);

echo "Income report:\n";
while ($row = $income_report->fetch_assoc()) {
  echo "  Income ID: " . $row['id'] . "\n";
  echo "  Amount: " . $row['amount'] . "\n";
  echo "  Category: " . $row['category'] . "\n";
  echo "  Description: " . $row['description'] . "\n";
  echo "  Date: " . $row['date'] . "\n";
}


?>
