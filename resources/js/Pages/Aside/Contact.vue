<script setup>
// Components
import Button from '@/Components/Buttons/Button.vue';
import Aside from '@/Components/Aside.vue';
// Components - Forms
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import TextArea from '@/Components/Forms/TextArea.vue';
import InputError from '@/Components/Forms/InputError.vue';
</script>

<template>
  <Aside>
    <div class="relative w-full xl:w-1/2">
      <h2 class="text-xl font-bold mb-3">お問い合わせ</h2>
      <div class="space-y-4">
        <div class="space-y-2">
          <p>
            Shuplay体操教室へのお問い合わせはこちらからお願いします。<br />
            入会に関するご相談、短期教室に関するご相談など、なんでもお気軽にご相談ください。<br />
            2〜3日経っても返信がない場合は、お問い合わせフォームが正しく送信されていない可能性がございます。<br />
            その際は、お手数ですが、再度送信していただくか、お電話でも承っております。<br />
            お電話につきましては、教室時間中は対応できない場合もございます。<br />
            予めご了承ください。
          </p>
        </div>
        <div class="space-y-2">
          <dl class="flex flex-col md:flex-row gap-4">
            <dt>住所:</dt>
            <dd>兵庫県尼崎市潮江1丁目16番1号<br />アミング潮江ウエスト二番館201-6</dd>
          </dl>
          <dl class="flex flex-col md:flex-row gap-4">
            <dt>電話番号:</dt>
            <dd>06-4950-6939</dd>
          </dl>
          <dl class="flex flex-col md:flex-row gap-4">
            <dt>メールアドレス:</dt>
            <dd>info@shuplay.com</dd>
          </dl>
        </div>
      </div>
    </div>
    <div class="relative w-full xl:w-1/2">
      <form action="">
        <div class="space-y-4">
          <div class="space-y-2">
            <InputLabel for="name" value="お名前" required />
            <TextInput
              type="text"
              id="name"
              name="name"
              class="block w-full"
              placeholder="お名前を入力してください。"
              required
            />
            <InputError />
          </div>
          <div class="space-y-2">
            <InputLabel for="email" value="メールアドレス" required />
            <TextInput
              type="email"
              id="email"
              name="email"
              class="block w-full"
              placeholder="sample@gmai.com"
              required
            />
            <InputError />
          </div>
          <div class="space-y-2">
            <InputLabel for="subject" value="件名" required />
            <TextInput
              type="text"
              id="subject"
              name="subject"
              class="block w-full"
              placeholder="件名を入力してください。"
              required
            />
            <InputError />
          </div>
          <div class="space-y-2">
            <InputLabel for="description" value="お問い合わせ内容" required />
            <TextArea
              id="content"
              class="block w-full"
              cols="30"
              rows="10"
              placeholder="内容を入力してください。"
              required
            />
            <InputError />
          </div>
          <div class="space-y-2">
            <Button buttonType="primary">送信する</Button>
          </div>
        </div>
      </form>
    </div>
  </Aside>
</template>