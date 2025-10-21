# Mortgage Calculator

A responsive mortgage calculator built with HTML, CSS, and JavaScript as a learning project inspired by Frontend Mentor challenges.

## Features

- Calculate monthly mortgage repayments
- Support for both repayment and interest-only mortgages
- Real-time input validation
- Responsive design for mobile and desktop
- Clean, modern UI with smooth interactions

## How to Use

1. Enter the mortgage amount
2. Enter the mortgage term in years
3. Enter the interest rate
4. Select the mortgage type (Repayment or Interest Only)
5. Click "Calculate Repayments" to see your results

## Formula

### Repayment Mortgage
Monthly Payment = P [ r(1 + r)^n ] / [ (1 + r)^n - 1 ]

Where:
- P = Principal loan amount
- r = Monthly interest rate (annual rate / 12)
- n = Total number of payments (years × 12)

### Interest Only Mortgage
Monthly Payment = P × r

Total Repayment = (Monthly Payment × n) + P

## Technologies Used

- HTML5
- CSS3 (with CSS Grid and Flexbox)
- Vanilla JavaScript

## Learning Goals

This project was built to practice:
- Semantic HTML structure
- CSS layout techniques (Grid, Flexbox)
- Form handling and validation
- JavaScript calculations and DOM manipulation
- Responsive web design
- Accessibility best practices
