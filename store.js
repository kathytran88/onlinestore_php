document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("shoppingCartForm");
  const product1Qty = document.getElementById("product1Qty");
  const product2Qty = document.getElementById("product2Qty");
  const shippingOptions = document.getElementsByName("shippingMethod");
  const subtotalEl = document.getElementById("subtotal");
  const shippingCostEl = document.getElementById("shippingCost");
  const grandTotalEl = document.getElementById("grandTotal");

  function calculateTotals() {
    const product1Price = 10.0;
    const product2Price = 20.0;

    const qty1 = parseInt(product1Qty.value) || 0;
    const qty2 = parseInt(product2Qty.value) || 0;

    // Calculate subtotal
    const subtotal = qty1 * product1Price + qty2 * product2Price;

    // Get shipping cost
    let shippingCost = 0;
    for (const option of shippingOptions) {
      if (option.checked) {
        shippingCost = parseFloat(option.value);
        break;
      }
    }

    // Calculate grand total
    const grandTotal = subtotal + shippingCost;

    // Update totals on the page
    subtotalEl.textContent = subtotal.toFixed(2);
    shippingCostEl.textContent = shippingCost.toFixed(2);
    grandTotalEl.textContent = grandTotal.toFixed(2);
  }

  // validate form
  function validateForm(event) {
    event.preventDefault(); 

    const requiredFields = ["customerName", "customerAddress", "customerZip", "customerPhone", "customerEmail", "customerCard"];
    for (const fieldId of requiredFields) {
      const field = document.getElementById(fieldId);
      if (!field.value.trim()) {
        alert(`${fieldId.replace("customer", "")} is required.`);
        field.focus();
        field.style.backgroundColor = "red";
        return;
      }
      field.style.backgroundColor = ""; 
    }
    
    // Validate ZIP code
    const zipCode = document.getElementById("customerZip").value;
    if (zipCode.length !== 5 || isNaN(zipCode)) {
      alert("Zip Code must be exactly 5 digits.");
      const field = document.getElementById("customerZip");
      field.focus();
      field.style.backgroundColor = "red";
      return;
    }

    form.submit();
  }

  form.addEventListener("change", calculateTotals);
  form.addEventListener("submit", validateForm);
});

  