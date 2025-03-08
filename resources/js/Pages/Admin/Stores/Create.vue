<script setup>
import { Head, useForm } from '@inertiajs/vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Button from '@/Components/Buttons/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
// Form Components
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import TextArea from '@/Components/Forms/TextArea.vue';
import InputError from '@/Components/Forms/InputError.vue';
import ImageUpload from '@/Components/Forms/ImageUpload.vue';
import Separator from '@/Components/Separator.vue';

const form = useForm({
  name: '',
  type: '',
  code: '',
  established_date: '',
  color_code: '',
  description: '',
  email: '',
  zipcode: '',
  address1: '',
  address2: '',
  address3: '',
  address4: '',
  phone_number: '',
  fax_number: '',
  website: '',
  facebook: '',
  twitter: '',
  instagram: '',
  youtube: '',
  line: '',
  store_photo_path: '',
  store_logo_path: '',
  status: '',
});

// const selectedFile = ref(null);
function handleFileUpload(identifier) {
  const files = inputFile.value.files;
  if (files.length) {
    FormData.append(identifier, files[0]);
  }
}

const submit = () => {
  form.post(route('admin.store.store'));
};
</script>

<template>
  <Head title="店舗管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">Store</h1>
        <div class="flex justify-end items-center gap-4">
          <Button :href="route('admin.store.index')" buttonType="primary">一覧</Button>
        </div>
      </div>
    </template>
    <Breadcrumb
      :items="[
        { name: 'Home', url: route('admin.dashboard') },
        { name: 'Store', url: route('admin.store.index') },
      ]"
    />
    <FlashMessage />
    <Alert
      :isVisible="showAlert"
      :message="`店舗を削除しますか？`"
      @confirm="confirmDeletion"
      @cancel="cancelDeletion"
    />

    <div class="w-full p-6 bg-slate-100 text-slate-700 dark:bg-gray-700 dark:text-slate-100">
      <div class="space-y-0.5">
        <h2 class="text-xl font-bold tracking-tight">新規作成</h2>
        <p class="text-slate-400">新規に店舗を作成するときに利用してください。</p>
      </div>
      <div class="shrink-0 bg-slate-300 h-[1px] w-full my-6"></div>
      <form @submit.prevent="submit" class="space-y-8">
        <div class="flex flex-col lg:flex-row">
          <div class="w-full lg:w-3/4 space-y-6">
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-1/3">
                <InputLabel for="name" value="店舗名" required />
                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  required
                  autofocus
                  placeholder="名前を入力してください。"
                  autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="w-1/3">
                <InputLabel for="type" value="店舗タイプ" required />
                <TextInput
                  id="type"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.type"
                  required
                  placeholder="タイプを入力してください。"
                  autocomplete="type"
                />
                <InputError class="mt-2" :message="form.errors.type" />
              </div>
              <div class="w-1/3"></div>
            </div>
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-1/3">
                <InputLabel for="code" value="店舗コード" required />
                <TextInput
                  id="code"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.code"
                  required
                  placeholder="コードを入力してください。"
                  autocomplete="code"
                />
                <InputError class="mt-2" :message="form.errors.code" />
              </div>
              <div class="w-1/3">
                <InputLabel for="established_date" value="設立日" required />
                <TextInput
                  id="established_date"
                  type="date"
                  class="mt-1 block w-full"
                  v-model="form.established_date"
                  required
                  placeholder="設立日を入力してください。"
                  autocomplete="established_date"
                />
                <InputError class="mt-2" :message="form.errors.established_date" />
              </div>
              <div class="w-1/3">
                <InputLabel for="color_code" value="カラーコード" required />
                <TextInput
                  id="color_code"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.color_code"
                  required
                  placeholder="カラーコードを入力してください。"
                  autocomplete="color_code"
                />
                <InputError class="mt-2" :message="form.errors.color_code" />
              </div>
            </div>
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-full">
                <InputLabel for="description" value="店舗概要" required />
                <TextArea id="content" class="mt-1 block w-full" v-model="form.content" />
                <InputError class="mt-2" :message="form.errors.description" />
              </div>
            </div>
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-1/3">
                <InputLabel for="email" value="メールアドレス" required />
                <TextInput
                  id="email"
                  type="email"
                  class="mt-1 block w-full"
                  v-model="form.email"
                  required
                  placeholder="メールアドレスを入力してください。"
                  autocomplete="email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
              </div>
            </div>
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-1/3">
                <InputLabel for="zipcode" value="郵便番号" required />
                <TextInput
                  id="zipcode"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.zipcode"
                  required
                  placeholder="郵便番号を入力してください。"
                  autocomplete="zipcode"
                />
                <InputError class="mt-2" :message="form.errors.zipcode" />
              </div>
              <div class="w-1/3">
                <InputLabel for="search" value="検索" />
                <Button>郵便番号から住所を検索</Button>
              </div>
            </div>
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-1/3">
                <InputLabel for="address1" value="都道府県名" required />
                <TextInput
                  id="address1"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.address1"
                  required
                  placeholder="都道府県名を入力してください。"
                  autocomplete="address1"
                />
                <InputError class="mt-2" :message="form.errors.address1" />
              </div>
              <div class="w-1/3">
                <InputLabel for="address2" value="市区町村名" required />
                <TextInput
                  id="address2"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.address2"
                  required
                  placeholder="市区町村名を入力してください。"
                  autocomplete="address2"
                />
                <InputError class="mt-2" :message="form.errors.address2" />
              </div>
              <div class="w-1/3">
                <InputLabel for="address3" value="地域名" required />
                <TextInput
                  id="address2"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.address2"
                  required
                  placeholder="地域名を入力してください。"
                  autocomplete="address2"
                />
                <InputError class="mt-2" :message="form.errors.address2" />
              </div>
            </div>
            <Separator />
            <!-- SNS -->
            <h3>Webサイト & SNS URL</h3>
            <div class="flex flex-col md:flex-row gap-5">
              <div class="w-1/2">
                <InputLabel for="website" value="WebサイトURL" />
                <TextInput
                  id="website"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.website"
                  required
                  placeholder="URLを入力してください。"
                  autocomplete="website"
                />
                <InputError class="mt-2" :message="form.errors.website" />
              </div>
            </div>
            <div class="flex flex-col md:flex-row flex-wrap gap-5">
              <div class="w-1/2">
                <InputLabel for="facebook" value="Facebook URL" />
                <TextInput
                  id="facebook"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.facebook"
                  required
                  placeholder="URLを入力してください。"
                  autocomplete="facebook"
                />
                <InputError class="mt-2" :message="form.errors.facebook" />
              </div>
              <div class="w-1/2">
                <InputLabel for="twitter" value="X(Twitter) URL" />
                <TextInput
                  id="twitter"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.twitter"
                  required
                  placeholder="URLを入力してください。"
                  autocomplete="twitter"
                />
                <InputError class="mt-2" :message="form.errors.twitter" />
              </div>
              <div class="w-1/2">
                <InputLabel for="instagram" value="Instagram URL" />
                <TextInput
                  id="instagram"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.instagram"
                  required
                  placeholder="URLを入力してください。"
                  autocomplete="instagram"
                />
                <InputError class="mt-2" :message="form.errors.instagram" />
              </div>
              <div class="w-1/2">
                <InputLabel for="youtube" value="YouTube URL" />
                <TextInput
                  id="youtube"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.youtube"
                  required
                  placeholder="URLを入力してください。"
                  autocomplete="youtube"
                />
                <InputError class="mt-2" :message="form.errors.youtube" />
              </div>
              <div class="w-1/2">
                <InputLabel for="line" value="LINE URL" />
                <TextInput
                  id="line"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.line"
                  required
                  placeholder="URLを入力してください。"
                  autocomplete="line"
                />
                <InputError class="mt-2" :message="form.errors.line" />
              </div>
            </div>
          </div>
          <div class="w-full lg:w-1/4 space-y-6">
            <div class="flex flex-col">
              <InputLabel for="store_photo_path" value="店舗画像" />
              <ImageUpload
                id="store_photo_path"
                v-model="form.store_photo_path"
                @change="handleFileUpload"
              />
            </div>
            <div class="flex flex-col">
              <InputLabel for="store_logo_path" value="ロゴ画像" />
              <ImageUpload
                id="store_lgoo_path"
                v-model="form.store_logo_path"
                @change="handleFileUpload"
              />
            </div>
          </div>
        </div>
        <div class="flex">
          <Button buttonType="primary">保存</Button>
        </div>
      </form>
    </div>
  </AdminDashboardLayout>
</template>