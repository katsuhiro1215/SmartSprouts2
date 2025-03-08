import validationMessages from '@/Constants/validationMessages';

export const validateStoreId = (form) => {
  form.errors.store_id = !form.store_id ? validationMessages.user.required : '';
};

export const validateUsername = (form) => {
  if (!form.username) {
    form.errors.username = validationMessages.user.required;
  } else if (form.username.length > 50) {
    form.errors.username = validationMessages.user.username;
  } else {
    delete form.errors.username;
  }
};

export const validateEmail = (form) => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!form.email) {
    form.errors.email = validationMessages.user.required;
  } else if (!emailPattern.test(form.email)) {
    form.errors.email = validationMessages.user.email;
  } else {
    delete form.errors.email;
  }
};

export const validatePassword = (form) => {
  const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
  if (!form.password) {
    form.errors.password = validationMessages.user.required;
  } else if (form.password.length < 8) {
    form.errors.password = validationMessages.user.password;
  } else if (!passwordPattern.test(form.password)) {
    form.errors.password = 'パスワードは8文字以上で、半角英数字を含めて入力してください。';
  } else {
    delete form.errors.password;
  }
};

export const validatePasswordConfirmation = (form) => {
  if (!form.password_confirmation) {
    form.errors.password_confirmation = validationMessages.user.required;
  } else if (form.password !== form.password_confirmation) {
    form.errors.password_confirmation = validationMessages.user.passwordConfirmation;
  } else {
    delete form.errors.password_confirmation;
  }
};

export const validateAllFields = (form) => {
  validateStoreId(form);
  validateUsername(form);
  validateEmail(form);
  validatePassword(form);
  validatePasswordConfirmation(form);
};
