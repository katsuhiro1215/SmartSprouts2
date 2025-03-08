export default {
  user: {
    required: 'この項目は入力必須です。',
    username: 'ユーザー名は50文字以内で入力してください。',
    email: 'メールアドレスの形式で入力してください。',
    emailUnique: 'このメールアドレスは既に使用されています。',
    password: 'パスワードは8文字以上で入力してください。',
    passwordConfirmation: 'パスワードが一致しません。',
  },
  // プロフィール
  profile: {
    required: 'この項目は入力必須です。',
    lastname: '名前(姓)は40文字以内で入力してください。',
    firstname: '名前(名)は40文字以内で入力してください。',
    lastnameKana: 'フリガナ(姓)は50文字以内で入力してください。',
    firstnameKana: 'フリガナ(名)は50文字以内で入力してください。',
    birth: '生年月日はYYYY-MM-DD形式で入力してください。',
    gender: '名前(名)性別は「男性」、「女性」、「その他」のいずれかを選択してください。',
    blood: '血液型は「A型」、「B型」、「O型」、「AB型」、「不明」のいずれかを選択してください。',
    mobileNumber: '携帯番号は10桁または11桁の数字で入力してください。',
    personamHistory: '既往歴は1000文字以内で入力してください。',
    memberNumber: '会員番号は20文字以内で入力してください。',
    membershipStatus: '会員状態は「会員」、「非会員」のいずれかを選択してください。',
  },
  address: {
    required: 'この項目は入力必須です。',
    zipCode: '郵便番号は7桁の数字で入力してください。',
    address1: '都道府県名は20文字以内で入力してください。',
    address2: '市区町村名は30文字以内で入力してください。',
    address3: '地域名は50文字以内で入力してください。',
    address4: 'それ以降の住所は100文字以内で入力してください。',
    phoneNumber: '電話番号は10桁または11桁の数字で入力してください。',
  },
  student: {
    mobileNumber: '緊急連絡先は10桁または11桁の数字で入力してください。',
    mobileNumberRelationShip: '緊急連絡先の続柄は20文字以内で入力してください。',
  },
  guardian: {
    relationship: '続柄は20文字以内で入力してください。',
    mobileNumber: '携帯番号は10桁または11桁の数字で入力してください。',
    companyName: '会社名は50文字以内で入力してください。',
    companyNumber: '会社電話番号は10桁または11桁の数字で入力してください。',
  },
  storeSchedules: {
    required: 'この項目は入力必須です。',
    closeTime: '閉店時間は開店時間より未来の時間を指定してください。',
    conflictSchedule: '一部すでに登録されている時間です。',
  },
};
