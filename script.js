// Get DOM elements
const mortgageForm = document.getElementById('mortgageForm');
const clearBtn = document.getElementById('clearBtn');
const resultsEmpty = document.getElementById('resultsEmpty');
const resultsCompleted = document.getElementById('resultsCompleted');
const monthlyPaymentEl = document.getElementById('monthlyPayment');
const totalPaymentEl = document.getElementById('totalPayment');

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(amount);
}

// Calculate mortgage
function calculateMortgage(amount, years, annualRate, type) {
    const monthlyRate = annualRate / 100 / 12;
    const numberOfPayments = years * 12;

    let monthlyPayment;
    let totalPayment;

    if (type === 'repayment') {
        // Calculate monthly payment for repayment mortgage
        // M = P [ r(1 + r)^n ] / [ (1 + r)^n - 1 ]
        if (monthlyRate === 0) {
            monthlyPayment = amount / numberOfPayments;
        } else {
            const x = Math.pow(1 + monthlyRate, numberOfPayments);
            monthlyPayment = amount * (monthlyRate * x) / (x - 1);
        }
        totalPayment = monthlyPayment * numberOfPayments;
    } else {
        // Interest only mortgage
        monthlyPayment = amount * monthlyRate;
        totalPayment = (monthlyPayment * numberOfPayments) + amount;
    }

    return {
        monthlyPayment: monthlyPayment,
        totalPayment: totalPayment
    };
}

// Validate form inputs
function validateForm(formData) {
    let isValid = true;
    const amount = parseFloat(formData.get('amount'));
    const term = parseFloat(formData.get('term'));
    const rate = parseFloat(formData.get('rate'));

    // Remove previous error states
    document.querySelectorAll('.input-wrapper').forEach(wrapper => {
        wrapper.classList.remove('error');
    });

    // Validate amount
    if (isNaN(amount) || amount <= 0) {
        document.querySelector('#amount').closest('.input-wrapper').classList.add('error');
        isValid = false;
    }

    // Validate term
    if (isNaN(term) || term <= 0) {
        document.querySelector('#term').closest('.input-wrapper').classList.add('error');
        isValid = false;
    }

    // Validate rate
    if (isNaN(rate) || rate < 0) {
        document.querySelector('#rate').closest('.input-wrapper').classList.add('error');
        isValid = false;
    }

    return isValid;
}

// Handle form submission
mortgageForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(mortgageForm);
    
    // Validate form
    if (!validateForm(formData)) {
        return;
    }

    // Get form values
    const amount = parseFloat(formData.get('amount'));
    const term = parseFloat(formData.get('term'));
    const rate = parseFloat(formData.get('rate'));
    const type = formData.get('type');

    // Calculate mortgage
    const results = calculateMortgage(amount, term, rate, type);

    // Display results
    monthlyPaymentEl.textContent = formatCurrency(results.monthlyPayment);
    totalPaymentEl.textContent = formatCurrency(results.totalPayment);

    // Show results section
    resultsEmpty.style.display = 'none';
    resultsCompleted.style.display = 'block';
});

// Handle clear button
clearBtn.addEventListener('click', function() {
    // Reset form
    mortgageForm.reset();
    
    // Remove error states
    document.querySelectorAll('.input-wrapper').forEach(wrapper => {
        wrapper.classList.remove('error');
    });
    
    // Hide results and show empty state
    resultsCompleted.style.display = 'none';
    resultsEmpty.style.display = 'block';
});

// Remove error state on input
document.querySelectorAll('.input-wrapper input').forEach(input => {
    input.addEventListener('input', function() {
        this.closest('.input-wrapper').classList.remove('error');
    });
});
