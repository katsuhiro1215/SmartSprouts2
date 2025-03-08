import validationMessages from '@/Constants/validationMessages';

export const validateZipCode = (form) => {
  const zipCodePattern = /^\d{7}$/;
  if (!form.zip_code) {
    form.errors.zip_code = validationMessages.address.required;
  } else if (!zipCodePattern.test(form.zip_code)) {
    form.errors.zip_code = validationMessages.address.zipCode;
  } else {
    delete form.errors.zipcode;
  }
}

export const validatePrefecture = (form) => {
  if (!form.address1) {
    form.errors.address1 = validationMessages.address.required;
  } else if (form.address1.length > 20) {
    form.errors.address1 = validationMessages.address.address1;
  } else {
    delete form.errors.address1;
  }
}

export const validateCity = (form) => {
  if (!form.address2) {
    form.errors.address2 = validationMessages.address.required;
  } else if (form.address2.length > 30) {
    form.errors.address2 = validationMessages.address.address2;
  } else {
    delete form.errors.address2;
  }
}

export const validateStreet = (form) => {
  if (!form.address3) {
    form.errors.address3 = validationMessages.address.required;
  } else if (form.address3.length > 50) {
    form.errors.address3 = validationMessages.address.address3;
  } else {
    delete form.errors.address3;
  }
}

export const validateBuilding = (form) => {
  if (!form.address4) {
    form.errors.address4 = validationMessages.address.required;
  } else if (form.address4.length > 100) {
    form.errors.address4 = validationMessages.address.address4;
  } else {
    delete form.errors.address4;
  }
}

export const validatePhoneNumber = (form) => {
  const phoneNumberPattern = /^\d{10,11}$/;
  if (!form.phone_number) {
    form.errors.phone_number = validationMessages.address.required;
  } else if (!phoneNumberPattern.test(form.phone_number)) {
    form.errors.phone_number = validationMessages.address.phoneNumber;
  } else {
    delete form.errors.phone_number;
  }
}

export const validateAllFields = (form) => {
  validateZipCode(form);
  validatePrefecture(form);
  validateCity(form);
  validateStreet(form);
  validateBuilding(form);
  validatePhoneNumber(form);
}