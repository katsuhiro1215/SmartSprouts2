// エラー内容と解決策を定義
export default {
    // 認証関連 admin & user 共通
    auth: {
        required: "この項目は入力必須です。",
        username: "ユーザー名は30文字以内で入力してください。",
        email: "メールアドレスの形式で入力してください。",
        emailUnique: "このメールアドレスは既に使用されています。",
        password: "パスワードは8文字以上で入力してください。",
        passwordConfirmation: "パスワードが一致しません。",
    },
    // // admin
    // admin: {},
    // // user
    // user: {},
    // // profile
    // profile: {},
    // // address
    // address: {},
    // // student
    // student: {},
    // // guardian
    // guardian: {},
};