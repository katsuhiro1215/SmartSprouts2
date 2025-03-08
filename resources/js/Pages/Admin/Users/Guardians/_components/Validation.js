import validationMessages from '@/Constants/validationMessages';

export const validateLastname = (form) => {
  if (!form.lastname) {
    form.errors.lastname = validationMessages.profile.required;
  } else if (form.lastname.length > 40) {
    form.errors.lastname = validationMessages.profile.lastname;
  } else {
    delete form.errors.lastname;
  }
}

export const validateFirstname = (form) => {
  if (!form.firstname) {
    form.errors.firstname = validationMessages.profile.required;
  } else if (form.firstname.length > 40) {
    form.errors.firstname = validationMessages.profile.firstname;
  } else {
    delete form.errors.firstname;
  }
}

export const validateLastnameKana = (form) => {
  if (!form.lastname_kana) {
    form.errors.lastname_kana = validationMessages.profile.required;
  } else if (form.lastname_kana.length > 40) {
    form.errors.lastname_kana = validationMessages.profile.lastnameKana;
  } else {
    delete form.errors.lastname_kana;
  }
}

export const validateFirstnameKana = (form) => {
  if (!form.firstname_kana) {
    form.errors.firstname_kana = validationMessages.profile.required;
  } else if (form.firstname_kana.length > 40) {
    form.errors.firstname_kana = validationMessages.profile.firstnameKana;
  } else {
    delete form.errors.firstname_kana;
  }
}

export const validateRelationship = (form) => {
  if (!form.relationship) {
    form.errors.relationship = validationMessages.profile.required;
  } else if (form.relationship.length > 20) {
    form.errors.relationship = validationMessages.guardian.relationship;
  } else {
    delete form.errors.relationship;
  }
}

export const validateBirth = (form) => {
  const datePattern = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD形式の正規表現
  const minDate = new Date('1940-01-01'); // 最小日付

  if (!form.birth) {
    delete form.errors.birth;
  } else {
    const birthDate = new Date(form.birth);
    if (!datePattern.test(form.birth)) {
      form.errors.birth = validationMessages.profile.birth;
    } else if (birthDate < minDate) {
      form.errors.birth = '1940年1月1日より前の日付は無効です。';
    } else {
      delete form.errors.birth;
    }
  }
};

export const validateGender = (form) => {
  const validGenders = ['男性', '女性', 'その他'];
  if (!form.gender || !validGenders.includes(form.gender)) {
    form.errors.gender = validationMessages.profile.required;
  } else {
    delete form.errors.gender;
  }
};

export const validateMobileNumber = (form) => {
  const mobileNumberPattern = /^\d{10,11}$/;
  if (!form.mobile_number) {
    form.errors.mobile_number = validationMessages.profile.required;
  } else if (!mobileNumberPattern.test(form.mobile_number)) {
    form.errors.mobile_number = validationMessages.guardian.mobileNumber;
  } else {
    delete form.errors.mobile_number;
  }
}

// 会社名
export const validateCompanyName = (form) => {
  if (!form.company_name) {
    form.errors.company_name = validationMessages.guardian.companyName;
  } else if (form.company_name.length > 50) {
    form.errors.company_name = validationMessages.guardian.companyName;
  } else {
    delete form.errors.company_name;
  }
}

// 会社連絡先は必須ではない
export const validateCompanyPhoneNumber = (form) => {
  const companyNumberPattern = /^\d{10,11}$/;
  if (form.company_number && !companyNumberPattern.test(form.company_number)) {
    form.errors.company_number = validationMessages.guardian.companyNumber;
  } else {
    delete form.errors.company_number;
  }  
}

export const validateIsTemporary = (form) => {
  if (form.is_temporary === null || form.is_temporary === undefined) {
    form.errors.is_temporary = validationMessages.profile.required;
  } else {
    delete form.errors.is_temporary;
  }
};

export const validateAllFields = (form) => {
  validateLastname(form);
  validateFirstname(form);
  validateLastnameKana(form);
  validateFirstnameKana(form);
  validateBirth(form);
  validateGender(form);
  validateMobileNumber(form);
  validateCompanyName(form);
  validateCompanyNumber(form);
  validateIsTemporary(form);
};