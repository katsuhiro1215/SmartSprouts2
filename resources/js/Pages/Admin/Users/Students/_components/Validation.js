import validationMessages from '@/Constants/validationMessages';

export const validateStoreId = (form) => {
  if (!form.store_id) {
    form.errors.store_id = validationMessages.profile.required;
  } else {
    delete form.errors.store_id;
  }
}

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

export const validateBirth = (form) => {
  const datePattern = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD形式の正規表現
  const minDate = new Date('1940-01-01'); // 最小日付
  const birthDate = new Date(form.birth);

  if (!form.birth) {
    form.errors.birth = validationMessages.profile.required;
  } else if (!datePattern.test(form.birth)) {
    form.errors.birth = validationMessages.profile.birth;
  } else if (birthDate < minDate) {
    form.errors.birth = '1940年1月1日より前の日付は無効です。';
  } else {
    delete form.errors.birth;
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

export const validateBlood = (form) => {
  const validBloodTypes = ['A型', 'B型', 'O型', 'AB型', '不明'];
  if (!form.blood || !validBloodTypes.includes(form.blood)) {
    form.errors.blood = validationMessages.profile.required;
  } else {
    delete form.errors.blood;
  }
};

export const validateMobileNumber = (form) => {
  const mobileNumberPattern = /^\d{10,11}$/;
  if (!form.mobile_number) {
    form.errors.mobile_number = validationMessages.profile.required;
  } else if (!mobileNumberPattern.test(form.mobile_number)) {
    form.errors.mobile_number = validationMessages.student.mobileNumber;
  } else {
    delete form.errors.mobile_number;
  }
}

export const validateMobileNumberRelationship = (form) => {
  if (!form.mobile_number_relationship) {
    form.errors.mobile_number_relationship = validationMessages.profile.required;
  } else if (form.mobile_number_relationship.length > 20) {
    form.errors.mobile_number_relationship = validationMessages.student.mobileNumberRelationShip;
  } else {
    delete form.errors.mobile_number_relationship;
  }
}

export const validatePersonalHistory = (form) => {
  if (form.personal_history && form.personal_history.length > 1000) {
    form.errors.personal_history = validationMessages.student.personal_history;
  } else {
    delete form.errors.personal_history;
  }
}

export const validateMembershipStatus = (form) => {
  if (form.membership_status && form.membership_status.length > 20) {
    form.errors.membership_status = validationMessages.profile.membershipStatus;
  } else {
    delete form.errors.membership_status;
  }
}

export const validateIsTemporary = (form) => {
  if (form.is_temporary === null || form.is_temporary === undefined) {
    form.errors.is_temporary = validationMessages.profile.required;
  } else {
    delete form.errors.is_temporary;
  }
};

export const validateSerialNumber = (form) => {
  if (form.serialNumber && form.serialNumber.length > 20) {
    form.errors.serialNumber = validationMessages.profile.serialNumber;
  } else {
    delete form.errors.serialNumber;
  }
}

export const validatePermissionPhoto = (form) => {
  if (form.permissionPhoto === null) {
    form.errors.permissionPhoto = validationMessages.profile.required;
  } else {
    delete form.errors.permissionPhoto;
  }
}

export const validatePermissionDm = (form) => {
  if (form.permissionDm === null) {
    form.errors.permissionDm = validationMessages.profile.required;
  } else {
    delete form.errors.permissionDm;
  }
}

export const validateRemarks = (form) => {
  if (form.remarks && form.remarks.length > 1000) {
    form.errors.remarks = validationMessages.profile.remarks;
  } else {
    delete form.errors.remarks;
  }
}

export const validateAllFields = (form) => {
  validateLastname(form);
  validateFirstname(form);
  validateLastnameKana(form);
  validateFirstnameKana(form);
  validateBirth(form);
  validateGender(form);
  validateBlood(form);
  validateMobileNumber(form);
  validateMobileNumberRelationship(form);
  validatePersonalHistory(form);
  validateMembershipStatus(form);
  validateIsTemporary(form);
  validateSerialNumber(form);
  validatePermissionPhoto(form);
  validatePermissionDm(form);
  validateRemarks(form);
};