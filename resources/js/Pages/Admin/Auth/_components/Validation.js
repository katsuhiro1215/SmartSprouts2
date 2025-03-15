import validationMessages from "@/Constants/validationMessages.js";

// username validation
export const validateUsername = (form) => {
    if (!form.username) {
        form.errors.username = validationMessages.auth.required;
    } else if (form.username.length > 30) {
        form.errors.username = validationMessages.auth.username;
    } else {
        delete form.errors.username;
    }
};

// email validation
export const validateEmail = (form) => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!form.email) {
        form.errors.email = validationMessages.auth.required;
    } else if (!emailPattern.test(form.email)) {
        form.errors.email = validationMessages.auth.email;
    } else {
        delete form.errors.email;
    }
};

// password validation
export const validatePassword = (form) => {
    const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
    if (!form.password) {
        form.errors.password = validationMessages.auth.required;
    } else if (form.password.length < 8) {
        form.errors.password = validationMessages.auth.password;
    } else if (!passwordPattern.test(form.password)) {
        form.errors.password =
            "パスワードは8文字以上で、半角英数字を含めて入力してください。";
    } else {
        delete form.errors.password;
    }
};

// password confirmation validation
export const validatePasswordConfirmation = (form) => {
    if (!form.password_confirmation) {
        form.errors.password_confirmation = validationMessages.auth.required;
    } else if (form.password !== form.password_confirmation) {
        form.errors.password_confirmation =
            validationMessages.auth.passwordConfirmation;
    } else {
        delete form.errors.password_confirmation;
    }
};

// validate all fields
export const validateAllFields = (form) => {
    validateUsername(form);
    validateEmail(form);
    validatePassword(form);
    validatePasswordConfirmation(form);
};
