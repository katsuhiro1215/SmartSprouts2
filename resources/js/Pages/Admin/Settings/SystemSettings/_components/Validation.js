import validationMessages from '@/Constants/validationMessages';

export const validateName = (form) => {
  if (!form.name) {
    form.errors.name = validationMessages.profile.required;
  } else if (form.name.length > 50) {
    form.errors.name = validationMessages.profile.name;
  } else {
    delete form.errors.name;
  }
}

export const validateDescription = (form) => {
  if (!form.description) {
    form.errors.description = validationMessages.profile.required;
  } else if (form.description.length > 1000) {
    form.errors.description = validationMessages.profile.description;
  } else {
    delete form.errors.description;
  }
}

export const validateVersion = (form) => {
  if (!form.version) {
    form.errors.version = validationMessages.systemSetting.required;
  } else if (form.version.length > 40) {
    form.errors.version = validationMessages.systemSetting.version;
  } else {
    delete form.errors.version;
  }
}

export const validateFrontend = (form) => {
  if (!form.frontend) {
    form.errors.frontend = validationMessages.systemSetting.required;
  } else if (form.frontend.length > 40) {
    form.errors.frontend = validationMessages.systemSetting.frontend;
  } else {
    delete form.errors.frontend;
  }
}

export const validateBackend = (form) => {
  if (!form.backend) {
    form.errors.backend = validationMessages.systemSetting.required;
  } else if (form.backend.length > 40) {
    form.errors.backend = validationMessages.systemSetting.backend;
  } else {
    delete form.errors.backend;
  }
}

export const validateWebsiteURL = (form) => {
  if (form.websiteURL && form.websiteURL.length > 255) {
    form.errors.websiteURL = validationMessages.systemSetting.URL;
  } else {
    delete form.errors.websiteURL;
  }
}

export const validateFacebookURL = (form) => {
  if (form.facebookURL && form.facebookURL.length > 255) {
    form.errors.facebookURL = validationMessages.systemSetting.URL;
  } else {
    delete form.errors.facebookURL;
  }
}

export const validateTwitterURL = (form) => {
  if (form.twitterURL && form.twitterURL.length > 255) {
    form.errors.twitterURL = validationMessages.systemSetting.URL;
  } else {
    delete form.errors.twitterURL;
  }
}

export const validateInstagramURL = (form) => {
  if (form.instagramURL && form.instagramURL.length > 255) {
    form.errors.instagramURL = validationMessages.systemSetting.URL;
  } else {
    delete form.errors.instagramURL;
  }
}

export const validateYoutubeURL = (form) => {
  if (form.youtubeURL && form.youtubeURL.length > 255) {
    form.errors.youtubeURL = validationMessages.systemSetting.URL;
  } else {
    delete form.errors.youtubeURL;
  }
}

export const validateLineURL = (form) => {
  if (form.lineURL && form.lineURL.length > 255) {
    form.errors.lineURL = validationMessages.systemSetting.URL;
  } else {
    delete form.errors.lineURL;
  }
}

export const validateOpeningDate = (form) => {
  if (!form.openingDate) {
    form.errors.openingDate = validationMessages.systemSetting.required;
  } else {
    delete form.errors.openingDate;
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