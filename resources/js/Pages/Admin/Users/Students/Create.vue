<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
// Components - Forms
import FormGroup from '@/Components/Forms/FormGroup.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextArea from '@/Components/Forms/TextArea.vue';
import RadioInput from '@/Components/Forms/RadioInput.vue';
import ImageUpload from '@/Components/Forms/ImageUpload.vue';
import InputError from '@/Components/Forms/InputError.vue';
// User - components
import UserSidebarLink from '../_components/UserSidebarLink.vue';
//icon
import Back from 'vue-material-design-icons/ArrowLeft.vue';
// Validation
import {
  validateStoreId,
  validateLastname,
  validateFirstname,
  validateLastnameKana,
  validateFirstnameKana,
  validateGender,
  validateBlood,
  validateMobileNumber,
  validateMobileNumberRelationship,
  validatePersonalHistory,
  validateMembershipStatus,
  validateIsTemporary,
  validateSerialNumber,
  validatePermissionPhoto,
  validatePermissionDm,
  validateRemarks,
  validateAllFields,
} from './_components/Validation';
import SelectInput from '@/Components/Forms/SelectInput.vue';

const props = defineProps({
  user: Object,
  stores: Array,
});

const form = useForm({
  user_id: props.user.id,
  username: props.user.username,
  store_id: '',
  lastname: '',
  firstname: '',
  lastname_kana: '',
  firstname_kana: '',
  birth: '',
  gender: '男性',
  blood: '不明',
  mobile_number: '',
  mobile_number_relationship: '',
  personal_history: '',
  membership_status: '会員',
  is_temporary: false,
  serial_no: '',
  permission_photo: true,
  permission_dm: true,
  remarks: '',
  student_photo_path: '',
});

// 店舗名
const stores = props.stores.map((store) => {
  return {
    value: store.id,
    label: store.name,
  };
});

// 年齢
const age = ref(null);

const calculateAge = (birthDate) => {
  const today = new Date();
  const birth = new Date(birthDate);
  let age = today.getFullYear() - birth.getFullYear();
  const monthDifference = today.getMonth() - birth.getMonth();
  if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
    age--;
  }
  return age;
};

watch(
  () => form.birth,
  (newBirth) => {
    if (newBirth) {
      age.value = calculateAge(newBirth);
    } else {
      age.value = null;
    }
  }
);

// 性別
const genderOptions = [
  { value: '男性', label: '男性' },
  { value: '女性', label: '女性' },
  { value: 'その他', label: 'その他' },
];

// 血液型
const bloodOptions = [
  { value: 'A型', label: 'A型' },
  { value: 'B型', label: 'B型' },
  { value: 'O型', label: 'O型' },
  { value: 'AB型', label: 'AB型' },
  { value: '不明', label: '不明' },
];

// 会員状態
const membershipStatusOptions = [
  { value: '会員', label: '会員' },
  { value: '非会員', label: '非会員' },
];

// 仮会員
const isTemporaryOptions = [
  { value: true, label: '有効' },
  { value: false, label: '無効' },
];

// 写真許可
const permissionPhotoOptions = [
  { value: true, label: '有効' },
  { value: false, label: '無効' },
];

// DM許可
const permissionDmOptions = [
  { value: true, label: '有効' },
  { value: false, label: '無効' },
];

// ファイルアップロード
const inputFile = ref(null);

function handleFileUpload(event) {
  const files = event.target.files;
  if (files.length) {
    const formData = new FormData();
    formData.append('student_photo_path', files[0]);
    form.student_photo_path = formData;
  }
}

// ローディング
const isLoading = ref(false);
const loadingText = ref('');

// ボタンの状態
const isFormValid = computed(() => {
  return Object.keys(form.errors).length === 0;
});

// 登録
const store = async () => {
  validateAllFields(form);

  if (Object.keys(form.errors).length === 0) {
    isLoading.value = true;
    loadingText.value = '登録中...';
    form.post(route('admin.student.store'), {
      onFinish: () => {
        isLoading.value = false;
        loadingText.value = '';
      },
    });
  }
};
</script>

<template>
  <Head title="生徒管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">生徒管理</h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Student', url: route('admin.student.index') },
            { name: 'Create', url: route('admin.student.create', ['user']) },
          ]"
        />
      </div>
    </template>
    <FlashMessage />
    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <div class="w-full flex gap-5">
      <UserSidebarLink />
      <div class="w-[calc(100%-64px)] sm:w-[calc(100%-80px)] lg:w-[calc(100%-96px)]">
        <Card>
          <template #header>
            <div class="flex justify-between">
              <div class="flex flex-col gap-2">
                <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300 leading-tight">
                  生徒新規作成
                </h2>
                <p>生徒情報を登録する画面です。</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button
                  :href="route('admin.student.index')"
                  buttonActionType="button"
                  buttonType="secondary"
                  ><Back />生徒一覧へ戻る</Button
                >
              </div>
            </div>
          </template>
          <template #content>
            <div class="space-y-6">
              <Wizard />
              <!-- Form -->
              <form @submit.prevent="store" class="space-y-6">
                <h3>生徒プロフィール</h3>
                <div class="flex flex-col lg:flex-row gap-4">
                  <div class="w-full sm:w-2/3 space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/2">
                        <InputLabel for="user_id" value="ユーザー名" required />
                        <TextInput type="text" v-model="form.username" readonly />
                        <InputError class="mt-2" :message="form.errors.user_id" />
                      </FormGroup>
                      <FormGroup class="w-1/2">
                        <InputLabel for="user_id" value="店舗名" required />
                        <SelectInput
                          v-model="form.store_id"
                          :options="stores"
                          @change="validateStoreId(form)"
                         />
                        <InputError class="mt-2" :message="form.errors.store_id" />
                      </FormGroup>
                    </div>
                    <hr>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/2">
                        <InputLabel for="lastname" value="名前(姓)" required />
                        <TextInput
                          id="lastname"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.lastname"
                          @blur="validateLastname(form)"
                          required
                          placeholder="名前(姓)を入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.lastname" />
                      </FormGroup>
                      <FormGroup class="w-1/2">
                        <InputLabel for="firstname" value="名前(名)" required />
                        <TextInput
                          id="firstname"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.firstname"
                          @blur="validateFirstname(form)"
                          required
                          placeholder="名前(名)を入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.firstname" />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/2">
                        <InputLabel for="lastname_kana" value="名前(姓)カナ" required />
                        <TextInput
                          id="lastname_kana"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.lastname_kana"
                          @blur="validateLastnameKana(form)"
                          required
                          placeholder="名前(姓)カナを入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.lastname_kana" />
                      </FormGroup>
                      <FormGroup class="w-1/2">
                        <InputLabel for="firstname_kana" value="名前(名)カナ" required />
                        <TextInput
                          id="firstname_kana"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.firstname_kana"
                          @blur="validateFirstnameKana(form)"
                          required
                          placeholder="名前(名)カナを入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.firstname_kana" />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/3">
                        <InputLabel for="birthday" value="生年月日" required />
                        <TextInput
                          id="birthday"
                          type="date"
                          class="mt-1 block w-full"
                          v-model="form.birth"
                          @blur="validateBirth(form)"
                          required
                          placeholder="生年月日を入力してください。"
                          :min="'1940-01-01'"
                        />
                        <InputError class="mt-2" :message="form.errors.birth" />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel for="age" value="年齢" />
                        <TextInput
                          id="age"
                          type="text"
                          class="mt-1 block w-full"
                          :value="age + '歳'"
                          readonly
                        />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/3">
                        <InputLabel for="gender" value="性別" required />
                        <RadioInput
                          v-model="form.gender"
                          @blur="validateGender(form)"
                          :name="'gender'"
                          :options="genderOptions"
                        />
                        <InputError class="mt-2" :message="form.errors.gender" />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel for="blood" value="血液型" />
                        <RadioInput
                          v-model="form.blood"
                          @blur="validateBlood(form)"
                          :name="'blood'"
                          :options="bloodOptions"
                        />
                        <InputError class="mt-2" :message="form.errors.blood" />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/3">
                        <InputLabel for="mobile_number" value="緊急連絡先" required />
                        <TextInput
                          id="mobile_number"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.mobile_number"
                          @blur="validateMobileNumber(form)"
                          required
                          placeholder="緊急連絡先を入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.mobile_number" />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel
                          for="mobile_number_relationship"
                          value="緊急連絡先の関係"
                          required
                        />
                        <TextInput
                          id="mobile_number_relationship"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.mobile_number_relationship"
                          @blur="validateMobileNumberRelationship(form)"
                          required
                          placeholder="緊急連絡先の関係を入力してください。"
                        />
                        <InputError
                          class="mt-2"
                          :message="form.errors.mobile_number_relationship"
                        />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup>
                        <InputLabel for="personal_history" value="既往歴" />
                        <TextArea
                          id="personal_history"
                          class="mt-1 block w-full"
                          v-model="form.personal_history"
                          @blur="validatePersonalHistory(form)"
                          placeholder="過去に病気や怪我などがあれば入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.personal_history" />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/3">
                        <InputLabel for="member_no" value="会員番号" />
                        <TextInput
                          id="member_no"
                          type="text"
                          class="mt-1 block w-full"
                          placeholder="会員の際に自動生成されます。"
                          disabled
                        />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel for="membership_status" value="会員状態" required />
                        <RadioInput
                          v-model="form.membership_status"
                          @blur="validateMembershipStatus(form)"
                          :name="'membership_status'"
                          :options="membershipStatusOptions"
                        />
                        <InputError class="mt-2" :message="form.errors.membership_status" />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel for="is_temporary" value="仮会員" required />
                        <RadioInput
                          v-model="form.is_temporary"
                          @blur="validateIsTemporary(form)"
                          :name="'is_temporary'"
                          :options="isTemporaryOptions"
                        />
                        <InputError class="mt-2" :message="form.errors.is_temporary" />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup class="w-1/3">
                        <InputLabel for="serial_no" value="シリアル番号" />
                        <TextInput
                          id="serial_no"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.serial_no"
                          @blur="validateSerialNumber(form)"
                          placeholder="シリアル番号を入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.serial_no" />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel for="permission_photo" value="写真許可" required />
                        <RadioInput
                          v-model="form.permission_photo"
                          @blur="validatePermissionPhoto(form)"
                          :name="'permission_photo'"
                          :options="permissionPhotoOptions"
                        />
                        <InputError class="mt-2" :message="form.errors.permission_photo" />
                      </FormGroup>
                      <FormGroup class="w-1/3">
                        <InputLabel for="permission_dm" value="DM許可" required />
                        <RadioInput
                          v-model="form.permission_dm"
                          @blur="validatePermissionDm(form)"
                          :name="'permission_dm'"
                          :options="permissionDmOptions"
                        />
                        <InputError class="mt-2" :message="form.errors.permission_dm" />
                      </FormGroup>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-4">
                      <FormGroup>
                        <InputLabel for="remarks" value="備考" />
                        <TextArea
                          id="remarks"
                          class="mt-1 block w-full"
                          v-model="form.remarks"
                          @blur="validateRemarks(form)"
                          placeholder="プロフィールに関するご希望があれば入力してください。"
                        />
                        <InputError class="mt-2" :message="form.errors.remarks" />
                      </FormGroup>
                    </div>
                  </div>
                  <div class="w-full sm:w-1/3">
                    <div class="flex flex-col">
                      <InputLabel for="student_photo_path" value="生徒画像" />
                      <ImageUpload
                        id="student_photo_path"
                        ref="inputFile"
                        v-model="form.student_photo_path"
                        @change="handleFileUpload"
                      />
                      <InputError class="mt-2" :message="form.errors.student_photo_path" />
                    </div>
                  </div>
                </div>
                <Button
                  :buttonType="isFormValid ? 'primary' : 'secondary'"
                  type="submit"
                  :disabled="!isFormValid"
                  >登録</Button
                >
              </form>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
