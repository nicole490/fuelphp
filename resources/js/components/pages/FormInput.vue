<template>
  <form>
    <h3>入力フォーム</h3>
    <div class="form-group">
      <label class="control-label">設問1</label>
      <div class="custom-control custom-radio">
        <input
          type="radio"
          class="custom-control-input"
          name="customRadio"
          id="custom-radio-1"
          value="one"
          v-on:change="onChange"
          checked
        />
        <label class="custom-control-label" for="custom-radio-1">選択肢1</label>
      </div>
      <div class="custom-control custom-radio">
        <input
          type="radio"
          class="custom-control-input"
          name="customRadio"
          id="custom-radio-2"
          value="two"
          v-on:change="onChange"
        />
        <label class="custom-control-label" for="custom-radio-2">選択肢2</label>
      </div>
      <div class="custom-control custom-radio">
        <input
          type="radio"
          class="custom-control-input"
          name="customRadio"
          id="custom-radio-3"
          value="three"
          v-on:change="onChange"
        />
        <label class="custom-control-label" for="custom-radio-3">選択肢3</label>
      </div>
      <input
        type="text"
        class="form-control d-inline col-md-1"
        :disabled="disabled"
        :value="text_value"
      />
      点
    </div>
    <h1>tyonnnn</h1>
    <div class="form-group">
      <div class="custom-control custom-radio">
        <input
          type="radio"
          class="custom-control-input"
          name="tyonbo"
          id="tyonbo_on"
          value="tyonbo_on"
          v-on:change="onChangeTyonbo"
          checked
        />
        <label class="custom-control-label" for="tyonbo_on">あり</label>
      </div>
      <div class="custom-control custom-radio">
        <input
          type="radio"
          class="custom-control-input"
          name="tyonbo"
          id="tyonbo_off"
          v-on:change="onChangeTyonbo"
          value="tyonbo_off"
        />
        <label class="custom-control-label" for="tyonbo_off">なし</label>
      </div>
    </div>
    <div v-show="show">
      ※ドラッグ＆ドロップで各項目を各エリアに移動できます。
      <div class="d-flex justify-content-between bg-dark p-3">
        <div
          class="bg-secondary p-2 m-2 w-100"
          @drop="dropList($event, 'A')"
          @dragover.prevent
          @dragenter.prevent
        >
          <h2 class="text-light">Category A</h2>
          <div
            class="bg-white m-2 p-2"
            v-for="(list,index) in CategoryA"
            :key="list.id"
            draggable
            @dragstart="dragList($event,list.id)"
          >
            <div>{{ list.name }}</div>
            <div class="text-right">
              <button type="button" class="btn btn-danger" v-on:click="deleteItem(index)">削除</button>
            </div>
          </div>
        </div>
        <div
          class="bg-secondary p-2 m-2 w-100"
          @drop="dropList($event, 'B')"
          @dragover.prevent
          @dragenter.prevent
        >
          <h2 class="text-light">Category B</h2>
          <div
            class="bg-white m-2 p-2"
            v-for="(list,index) in CategoryB"
            :key="list.id"
            draggable
            @dragstart="dragList($event,list.id)"
          >
            <div>{{ list.name }}</div>
            <div class="text-right">
              <button type="button" class="btn btn-danger" v-on:click="deleteItem(index)">削除</button>
            </div>
          </div>
        </div>
        <div
          class="bg-secondary p-2 m-2 w-100"
          @drop="dropList($event, 'C')"
          @dragover.prevent
          @dragenter.prevent
        >
          <h2 class="text-light">Category C</h2>
          <div
            class="bg-white m-2 p-2"
            v-for="(list,index) in CategoryC"
            :key="list.id"
            draggable
            @dragstart="dragList($event,list.id)"
          >
            <div>{{ list.name }}</div>
            <div class="text-right">
              <button type="button" class="btn btn-danger" v-on:click="deleteItem(index)">削除</button>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-2">
        <input type="text" class="form-control d-inline col-md-5" v-model="tyonbo_text" />を
        <div class="custom-control custom-radio">
          <input
            type="radio"
            class="custom-control-input"
            name="tyonbo_select"
            id="tyonbo_select-1"
            value="A"
            v-model="category"
            checked
          />
          <label class="custom-control-label" for="tyonbo_select-1">Category A</label>
        </div>
        <div class="custom-control custom-radio">
          <input
            type="radio"
            class="custom-control-input"
            name="tyonbo_select"
            id="tyonbo_select-2"
            value="B"
            v-model="category"
          />
          <label class="custom-control-label" for="tyonbo_select-2">Category B</label>
        </div>
        <div class="custom-control custom-radio">
          <input
            type="radio"
            class="custom-control-input"
            name="tyonbo_select"
            id="tyonbo_select-3"
            value="C"
            v-model="category"
          />
          <label class="custom-control-label" for="tyonbo_select-3">Category C</label>
        </div>に
        <button type="button" class="btn btn-primary" v-on:click="addTyonbo">追加</button>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  data() {
    return {
      disabled: true, // 初期値の設定
      text_value: "",
      show: true,
      category: "A",
      tyonbo_text: "",
      lists: [
        {
          id: 1,
          name: "ProductA",
          category: "A"
        },
        {
          id: 2,
          name: "ProductB",
          category: "B"
        },
        {
          id: 3,
          name: "ProductC",
          category: "B"
        },
        {
          id: 4,
          name: "ProductD",
          category: "C"
        },
        {
          id: 5,
          name: "ProductE",
          category: "A"
        }
      ]
    };
  },
  computed: {
    CategoryA() {
      return this.lists.filter(list => list.category == "A");
    },
    CategoryB() {
      return this.lists.filter(list => list.category == "B");
    },
    CategoryC() {
      return this.lists.filter(list => list.category == "C");
    }
  },
  methods: {
    onChange(event) {
      // クリックイベントでイベント発火
      if (event.target.value === "three") {
        // input type="radio"のvalueを取得して判定
        this.disabled = false;
      } else {
        this.disabled = true;
        this.text_value = "";
      }
    },
    onChangeTyonbo(event) {
      // クリックイベントでイベント発火
      if (event.target.value === "tyonbo_on") {
        // input type="radio"のvalueを取得して判定
        this.show = true;
      } else {
        this.show = false;
      }
    },
    dragList(event, dragId) {
      event.dataTransfer.effectAllowed = "move";
      event.dataTransfer.dropEffect = "move";
      event.dataTransfer.setData("list-id", dragId);
    },
    dropList(event, dropCategory) {
      const dragId = event.dataTransfer.getData("list-id");
      const dragList = this.lists.find(list => list.id == dragId);
      dragList.category = dropCategory;
    },
    addTyonbo(event) {
      console.log(this.category);
      const last = this.lists.slice(-1)[0];
      console.log(last.id + 1);
      const item = {
        id: last.id + 1,
        name: this.tyonbo_text,
        category: this.category
      };
      this.lists.push(item);
    },
    deleteItem(index) {
        this.lists.splice(index, 1);
    }
  }
};
</script>