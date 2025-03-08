<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Card from '@/Components/Cards/Card.vue';
import Button from '@/Components/Buttons/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import LoadingIndicator from '@/Components/Loading/LoadingIndicator.vue';
// Components - Forms
import FormGroup from '@/Components/Forms/FormGroup.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
// User - components
import UserSidebarLink from '../_components/UserSidebarLink.vue';
// Icons
import Back from 'vue-material-design-icons/ArrowLeft.vue';
// API
import YubinBango from 'yubinbango-core2';
// Validation
import {
  validateZipCode,
  validatePrefecture,
  validateCity,
  validateStreet,
  validateBuilding,
  validatePhoneNumber,
  validateAllFields,
} from './_components/Validation';

const props = defineProps({
  user: Object,
});

const form = useForm({
  user_id: props.user.id,
  username: props.user.username,
  zipcode: '',
  address1: '',
  address2: '',
  address3: '',
  address4: '',
  phone_number: '',
});

const isLoading = ref(false);
const loadingText = ref('');

const fetchAddress = () => {
  const yubin = new YubinBango.Core(form.zipcode, (address) => {
    form.address1 = address.region;
    form.address2 = address.locality;
    form.address3 = address.street;
  });
};
const submitButtonType = computed(() => {
  return form.user_id &&
    form.zipcode &&
    form.address1 &&
    form.address2 &&
    form.address3 &&
    form.address4 &&
    form.phone_number
    ? 'primary'
    : 'secondary';
});

const isSubmitDisabled = computed(() => {
  return !(
    form.user_id &&
    form.zipcode &&
    form.address1 &&
    form.address2 &&
    form.address3 &&
    form.address4 &&
    form.phone_number
  );
});

const store = async () => {
  validateAllFields(form);

  isLoading.value = true;
  loadingText.value = '登録中...';
  form.post(route('admin.userAddress.store', { user: user.id }), {
    onFinish: () => {
      isLoading.value = false;
      loadingText.value = '';
    },
  });
};
</script>

<template>
  <Head title="ユーザー住所管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">ユーザー住所管理</h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'User', url: route('admin.user.index') },
            { name: 'UserAddress', url: route('admin.userAddress.create', ['user']) },
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
                  ユーザー住所新規作成
                </h2>
                <p>ユーザー住所を新規作成することができます。</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button
                  :href="route('admin.user.show', { user: $page.props.user.id })"
                  buttonActionType="button"
                  buttonType="secondary"
                  ><Back />戻る</Button
                >
              </div>
            </div>
          </template>
          <template #content>
            <div class="space-y-6">
              <!-- Form -->
              <form @submit.prevent="store" class="space-y-6">
                <div class="w-full sm:w-1/2 lg:w-2/3 space-y-4">
                  <div class="flex flex-col gap-4">
                    <InputLabel for="user_id" value="ユーザー名" required />
                    <TextInput type="text" v-model="form.username" readonly />
                    <InputError class="mt-2" :message="form.errors.user_id" />
                  </div>
                  <div class="flex flex-col lg:flex-row gap-4">
                    <FormGroup class="lg:w-1/3">
                      <InputLabel for="zipcode" value="郵便番号" required />
                      <TextInput
                        id="zipcode"
                        type="text"
                        v-model="form.zipcode"
                        @blur="validateZipCode(form)"
                        required
                        placeholder="郵便番号を入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.zipcode" />
                    </FormGroup>
                    <FormGroup class="lg:w-1/3">
                      <InputLabel for="search" value="検索" />
                      <Button @click.prevent="fetchAddress">郵便番号から住所を検索</Button>
                    </FormGroup>
                  </div>
                  <div class="flex flex-col lg:flex-row gap-4">
                    <FormGroup class="lg:w-1/3">
                      <InputLabel for="address1" value="都道府県" required />
                      <TextInput
                        id="address1"
                        type="text"
                        v-model="form.address1"
                        @blur="validatePrefecture(form)"
                        required
                        placeholder="都道府県名を入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.address1" />
                    </FormGroup>
                    <FormGroup class="lg:w-1/3">
                      <InputLabel for="address2" value="市区町村名" required />
                      <TextInput
                        id="address2"
                        type="text"
                        v-model="form.address2"
                        @blur="validateCity(form)"
                        required
                        placeholder="市区町村名を入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.address2" />
                    </FormGroup>
                    <FormGroup class="lg:w-1/3">
                      <InputLabel for="address3" value="地域名" required />
                      <TextInput
                        id="address3"
                        type="text"
                        v-model="form.address3"
                        @blur="validateStreet(form)"
                        required
                        placeholder="地域名を入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.address3" />
                    </FormGroup>
                  </div>
                  <div class="flex flex-col space-y-2">
                    <FormGroup>
                      <InputLabel for="address4" value="建物名その他" required />
                      <TextInput
                        id="address4"
                        type="text"
                        v-model="form.address4"
                        @blur="validateBuilding(form)"
                        required
                        placeholder="建物名その他住所を入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.address4" />
                    </FormGroup>
                  </div>
                  <div class="flex flex-col space-y-2">
                    <FormGroup class="lg:w-1/2">
                      <InputLabel for="phone_number" value="電話番号" required />
                      <TextInput
                        id="phone_number"
                        type="text"
                        v-model="form.phone_number"
                        @blur="validatePhoneNumber(form)"
                        required
                        placeholder="電話番号を入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.phone_number" />
                    </FormGroup>
                  </div>
                </div>
                <Button :buttonType="submitButtonType" type="submit" :disabled="isSubmitDisabled"
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