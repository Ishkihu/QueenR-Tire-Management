<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TIRE Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            color: #3498db;
            margin-top: 30px;
        }
        .form-container {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="tel"],
        textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .button-group button.cancel {
            background-color: #e74c3c;
        }
        .button-group button.cancel:hover {
            background-color: #c0392b;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>E-TIRE Management System</h1>
    
    <!-- INTERNAL OPERATIONS DOMAIN -->
    
    <h2>Internal Operations Domain</h2>
    
    <!-- Roles Form -->
    <div class="form-container">
        <h3>Roles Management</h3>
        <form id="rolesForm">
            <div class="form-group">
                <label for="roleName">Role Name*</label>
                <input type="text" id="roleName" name="name" required>
            </div>
            <div class="form-group">
                <label for="roleDescription">Description</label>
                <textarea id="roleDescription" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="accessLevel">Access Level*</label>
                <input type="number" id="accessLevel" name="access_level" min="1" max="10" required>
            </div>
            <div class="button-group">
                <button type="submit">Save Role</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Employee Form -->
    <div class="form-container">
        <h3>Employee Management</h3>
        <form id="employeeForm">
            <div class="form-group">
                <label for="employeeCode">Employee Code*</label>
                <input type="text" id="employeeCode" name="employee_code" required>
            </div>
            <div class="form-group">
                <label for="firstName">First Name*</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name*</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="roleId">Role*</label>
                <select id="roleId" name="role_id" required>
                    <option value="">Select Role</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status*</label>
                <select id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="on-leave">On Leave</option>
                    <option value="terminated">Terminated</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Save Employee</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Inventory Form -->
    <div class="form-container">
        <h3>Inventory Management</h3>
        <form id="inventoryForm">
            <div class="form-group">
                <label for="vehicleType">Vehicle Type*</label>
                <input type="text" id="vehicleType" name="vehicleType" required>
            </div>
            <div class="form-group">
                <label for="itemType">Item Type*</label>
                <input type="text" id="itemType" name="itemType" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand*</label>
                <input type="text" id="brand" name="brand" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity*</label>
                <input type="number" id="quantity" name="quantity" min="0" required>
            </div>
            <div class="form-group">
                <label for="price">Price*</label>
                <input type="number" id="price" name="price" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="cost">Cost*</label>
                <input type="number" id="cost" name="cost" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="status">Status*</label>
                <select id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="low">Low Stock</option>
                    <option value="discontinued">Discontinued</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Save Item</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Supplier Form -->
    <div class="form-container">
        <h3>Supplier Management</h3>
        <form id="supplierForm">
            <div class="form-group">
                <label for="supplierName">Name*</label>
                <input type="text" id="supplierName" name="name" required>
            </div>
            <div class="form-group">
                <label for="contactPerson">Contact Person*</label>
                <input type="text" id="contactPerson" name="contact_person" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone*</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="accountNumber">Account Number</label>
                <input type="text" id="accountNumber" name="account_number">
            </div>
            <div class="form-group">
                <label for="status">Status*</label>
                <select id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Save Supplier</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Expenses Form -->
    <div class="form-container">
        <h3>Expenses Management</h3>
        <form id="expensesForm">
            <div class="form-group">
                <label for="category">Category*</label>
                <input type="text" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount*</label>
                <input type="number" id="amount" name="amount" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="transactionDate">Transaction Date*</label>
                <input type="date" id="transactionDate" name="transaction_date" required>
            </div>
            <div class="form-group">
                <label for="approvedBy">Approved By*</label>
                <select id="approvedBy" name="approved_by" required>
                    <option value="">Select Employee</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Save Expense</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Service Log Form -->
    <div class="form-container">
        <h3>Service Log</h3>
        <form id="serviceLogForm">
            <div class="form-group">
                <label for="serviceId">Service ID*</label>
                <select id="serviceId" name="service_id" required>
                    <option value="">Select Service</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="paymentId">Payment ID</label>
                <select id="paymentId" name="payment_id">
                    <option value="">Select Payment (Optional)</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="timestamp">Timestamp*</label>
                <input type="datetime-local" id="timestamp" name="timestamp" required>
            </div>
            <div class="form-group">
                <label for="activityType">Activity Type*</label>
                <input type="text" id="activityType" name="activity_type" required>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="partsUsed">Parts Used</label>
                <textarea id="partsUsed" name="parts_used" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="employeeId">Employee*</label>
                <select id="employeeId" name="employee_id" required>
                    <option value="">Select Employee</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="vehicleDetails">Vehicle Details</label>
                <input type="text" id="vehicleDetails" name="vehicle_details">
            </div>
            <div class="button-group">
                <button type="submit">Save Service Log</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- CUSTOMER OPERATIONS DOMAIN -->
    
    <h2>Customer Operations Domain</h2>
    
    <!-- Customer Form -->
    <div class="form-container">
        <h3>Customer Management</h3>
        <form id="customerForm">
            <div class="form-group">
                <label for="customerNumber">Customer Number*</label>
                <input type="text" id="customerNumber" name="customer_number" required>
            </div>
            <div class="form-group">
                <label for="firstName">First Name*</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name*</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact*</label>
                <input type="tel" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <label for="loyaltyPoints">Loyalty Points</label>
                <input type="number" id="loyaltyPoints" name="loyalty_points" min="0" value="0">
            </div>
            <div class="button-group">
                <button type="submit">Save Customer</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Sale Form -->
    <div class="form-container">
        <h3>Sale Management</h3>
        <form id="saleForm">
            <div class="form-group">
                <label for="invoiceNumber">Invoice Number*</label>
                <input type="text" id="invoiceNumber" name="invoice_number" required>
            </div>
            <div class="form-group">
                <label for="saleDate">Sale Date*</label>
                <input type="date" id="saleDate" name="sale_date" required>
            </div>
            <div class="form-group">
                <label for="customerId">Customer*</label>
                <select id="customerId" name="customer_id" required>
                    <option value="">Select Customer</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="employeeId">Employee*</label>
                <select id="employeeId" name="employee_id" required>
                    <option value="">Select Employee</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="subtotal">Subtotal*</label>
                <input type="number" id="subtotal" name="subtotal" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="taxAmount">Tax Amount*</label>
                <input type="number" id="taxAmount" name="tax_amount" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="totalAmount">Total Amount*</label>
                <input type="number" id="totalAmount" name="total_amount" min="0" step="0.01" required>
            </div>
            <div class="button-group">
                <button type="submit">Save Sale</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Sale Item Form -->
    <div class="form-container">
        <h3>Sale Item</h3>
        <form id="saleItemForm">
            <div class="form-group">
                <label for="saleId">Sale*</label>
                <select id="saleId" name="sale_id" required>
                    <option value="">Select Sale</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="inventoryId">Inventory Item*</label>
                <select id="inventoryId" name="inventory_id" required>
                    <option value="">Select Item</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity*</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="unitPrice">Unit Price*</label>
                <input type="number" id="unitPrice" name="unit_price" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="lineTotal">Line Total*</label>
                <input type="number" id="lineTotal" name="line_total" min="0" step="0.01" required>
            </div>
            <div class="button-group">
                <button type="submit">Add Sale Item</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Services Form -->
    <div class="form-container">
        <h3>Services Management</h3>
        <form id="servicesForm">
            <div class="form-group">
                <label for="serviceName">Service Name*</label>
                <input type="text" id="serviceName" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price*</label>
                <input type="number" id="price" name="price" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="scheduledDate">Scheduled Date*</label>
                <input type="datetime-local" id="scheduledDate" name="scheduled_date" required>
            </div>
            <div class="form-group">
                <label for="assignedEmployeeId">Assigned Employee*</label>
                <select id="assignedEmployeeId" name="assigned_employee_id" required>
                    <option value="">Select Employee</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="customerId">Customer*</label>
                <select id="customerId" name="customer_id" required>
                    <option value="">Select Customer</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status*</label>
                <select id="status" name="status" required>
                    <option value="scheduled">Scheduled</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Save Service</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Payment Form -->
    <div class="form-container">
        <h3>Payment Management</h3>
        <form id="paymentForm">
            <div class="form-group">
                <label for="saleId">Sale</label>
                <select id="saleId" name="sale_id">
                    <option value="">Select Sale (Optional)</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="servicesId">Service</label>
                <select id="servicesId" name="services_id">
                    <option value="">Select Service (Optional)</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="customerId">Customer*</label>
                <select id="customerId" name="customer_id" required>
                    <option value="">Select Customer</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="form-group">
                <label for="transactionCode">Transaction Code*</label>
                <input type="text" id="transactionCode" name="transaction_code" required>
            </div>
            <div class="form-group">
                <label for="paymentDate">Payment Date*</label>
                <input type="datetime-local" id="paymentDate" name="payment_date" required>
            </div>
            <div class="form-group">
                <label for="paymentMethod">Payment Method*</label>
                <select id="paymentMethod" name="payment_method" required>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Check">Check</option>
                    <option value="Online">Online</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount*</label>
                <input type="number" id="amount" name="amount" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="referenceNumber">Reference Number</label>
                <input type="text" id="referenceNumber" name="reference_number">
            </div>
            <div class="form-group">
                <label for="status">Status*</label>
                <select id="status" name="status" required>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                    <option value="Failed">Failed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="employeeId">Employee*</label>
                <select id="employeeId" name="employee_id" required>
                    <option value="">Select Employee</option>
                    <!-- Options will be loaded from database -->
                </select>
            </div>
            <div class="button-group">
                <button type="submit">Save Payment</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- FINANCIAL DOMAIN -->
    
    <h2>Financial Domain</h2>
    
    <!-- Profit Form -->
    <div class="form-container">
        <h3>Profit Recording</h3>
        <form id="profitForm">
            <div class="form-group">
                <label for="periodStartDate">Period Start Date*</label>
                <input type="date" id="periodStartDate" name="period_start_date" required>
            </div>
            <div class="form-group">
                <label for="periodEndDate">Period End Date*</label>
                <input type="date" id="periodEndDate" name="period_end_date" required>
            </div>
            <div class="form-group">
                <label for="totalRevenue">Total Revenue*</label>
                <input type="number" id="totalRevenue" name="total_revenue" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="totalExpenses">Total Expenses*</label>
                <input type="number" id="totalExpenses" name="total_expenses" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="netProfit">Net Profit*</label>
                <input type="number" id="netProfit" name="net_profit" step="0.01" required>
            </div>
            <div class="button-group">
                <button type="submit">Save Profit Record</button>
                <button type="reset" class="cancel">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Monthly Summary Form -->
<div class="form-container">
    <h3>Monthly Summary</h3>
    <form id="monthlySummaryForm">
        <div class="form-group">
            <label for="month">Month*</label>
            <input type="date" id="month" name="month" required>
        </div>
        <div class="form-group">
            <label for="totalSales">Total Sales*</label>
            <input type="number" id="totalSales" name="total_sales" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="totalServices">Total Services*</label>
            <input type="number" id="totalServices" name="total_services" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="monthlySummaryExpenses">Total Expenses*</label>
            <input type="number" id="monthlySummaryExpenses" name="total_expenses" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="customerCount">Customer Count*</label>
            <input type="number" id="customerCount" name="customer_count" min="0" required>
        </div>
        <div class="form-group">
            <label for="topEmployeeId">Top Employee ID</label>
            <input type="number" id="topEmployeeId" name="top_employee_id">
        </div>
        <div class="button-group">
            <button type="submit">Save Monthly Summary</button>
            <button type="reset" class="cancel">Cancel</button>
        </div>
    </form>
</div>

<!-- Employee Performance Form -->
<div class="form-container">
    <h3>Employee Performance</h3>
    <form id="employeePerformanceForm">
        <div class="form-group">
            <label for="employeeId">Employee ID*</label>
            <input type="number" id="employeeId" name="employee_id" required>
        </div>
        <div class="form-group">
            <label for="perfPeriodStartDate">Period Start Date*</label>
            <input type="date" id="perfPeriodStartDate" name="period_start_date" required>
        </div>
        <div class="form-group">
            <label for="perfPeriodEndDate">Period End Date*</label>
            <input type="date" id="perfPeriodEndDate" name="period_end_date" required>
        </div>
        <div class="form-group">
            <label for="empTotalSales">Total Sales*</label>
            <input type="number" id="empTotalSales" name="total_sales" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="empTotalServices">Total Services*</label>
            <input type="number" id="empTotalServices" name="total_services" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="performanceRating">Performance Rating*</label>
            <input type="number" id="performanceRating" name="performance_rating" min="0" max="5" step="0.1" required>
        </div>
        <div class="button-group">
            <button type="submit">Save Performance Record</button>
            <button type="reset" class="cancel">Cancel</button>
        </div>
    </form>
</div>

<!-- Payment Form -->
<div class="form-container">
    <h3>Payment</h3>
    <form id="paymentForm">
        <div class="form-group">
            <label for="saleId">Sale ID</label>
            <input type="number" id="saleId" name="sale_id">
        </div>
        <div class="form-group">
            <label for="servicesId">Services ID</label>
            <input type="number" id="servicesId" name="services_id">
        </div>
        <div class="form-group">
            <label for="paymentCustomerId">Customer ID*</label>
            <input type="number" id="paymentCustomerId" name="customer_id" required>
        </div>
        <div class="form-group">
            <label for="transactionCode">Transaction Code*</label>
            <input type="text" id="transactionCode" name="transaction_code" required>
        </div>
        <div class="form-group">
            <label for="paymentDate">Payment Date*</label>
            <input type="datetime-local" id="paymentDate" name="payment_date" required>
        </div>
        <div class="form-group">
            <label for="paymentMethod">Payment Method*</label>
            <select id="paymentMethod" name="payment_method" required>
                <option value="">-- Select Payment Method --</option>
                <option value="Cash">Cash</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Check">Check</option>
                <option value="Online">Online</option>
            </select>
        </div>
        <div class="form-group">
            <label for="paymentAmount">Amount*</label>
            <input type="number" id="paymentAmount" name="amount" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="referenceNumber">Reference Number</label>
            <input type="text" id="referenceNumber" name="reference_number">
        </div>
        <div class="form-group">
            <label for="paymentStatus">Status*</label>
            <select id="paymentStatus" name="status" required>
                <option value="">-- Select Status --</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
                <option value="Failed">Failed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="paymentEmployeeId">Employee ID*</label>
            <input type="number" id="paymentEmployeeId" name="employee_id" required>
        </div>
        <div class="button-group">
            <button type="submit">Process Payment</button>
            <button type="reset" class="cancel">Cancel</button>
        </div>
    </form>
</div>