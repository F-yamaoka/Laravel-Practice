import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';

export default class MyComponent extends Component {
  constructor(props){
    super(props);
    this.getAddressData = this.getAddressData.bind(this);
    this.callZipcodeApi = this.callZipcodeApi.bind(this);
    this.callDeleteAction = this.callDeleteAction.bind(this);
    this.callRandomInsertAction = this.callRandomInsertAction.bind(this);

  

    // 初期json呼び出し
    this.getAddressData();
    this.state = {
      status : '更新中',
      msg :'',
    };
  }

  //
  //
  // テーブル更新
  getAddressData(event){
    this.setState((state)=>({
      status : '更新中',
      msg :'',
    }));
    const url = "/zipcode/reactapp/address_api";
    axios.get(url).then(response => {
      let tmp_items = response.data;

      // 分岐：データの有無
      if (tmp_items.length > 0) {
        this.setState((state)=>({
          status : '完了',
          items : tmp_items,
        }));
      }else{
        this.setState((state)=>({
          status : '完了',
          msg : 'データがありません',
          items : tmp_items,
        }));
      }
    });
    return;
  }

  //
  //
  // zip code api呼び出し
  callZipcodeApi(event){
    
    let zipcode ='' + document.getElementById('zipcode').value;
    zipcode =  zipcode.replace('-','');
    
    // zipcode　バリデーション
    if (zipcode ===''){
      this.setState((state)=>({
        status : '完了',
        msg : '未入力',
      }));
      return;
    }

    if (zipcode.length < 7){
      this.setState((state)=>({
        status : '完了',
        msg : '',
        zipcodeItem : '',
      }));
      return;
    }

    if (zipcode.length > 7){
      this.setState((state)=>({
        status : '完了',
        msg : '',
        zipcodeItem : '',
      }));
      return;
    }

    this.setState((state)=>({
      status : '更新中',
      err :'',
    }));

    let url = '/zipcode/reactapp/zipcode_api/' + zipcode;
    axios.get(url).then(response => {
      console.log(response.data.id);
      console.log(response.data.zipcode);

      // リザルトが帰ってきた場合
      if(response.data.id > 0) {
        this.setState((state)=>({
          status : '完了',
          zipcodeItem : response.data,
          msg : '',
        }));
        return;
      }

      // 何も帰ってこなかった場合
      this.setState((state)=>({
        status : '完了',
        msg : '住所の取得に失敗しました' 
      }));
    });
    return;
  }
  
  //
  //
  // 住所をテーブルに追加する処理
  callInsetAction(zipcode =-1, event){
    // zipcode　バリデーション
    if (zipcode=== -1){
      this.setState((state)=>({
        status : '完了',
        msg : '郵便番号を入力して住所を表示してください',
      }));
      return;
    }
    this.setState((state)=>({
      status : '更新中',
      msg : '',
    }));

    // 追加処理
    const url = "/zipcode/reactapp/insert/"+zipcode;
    axios.get(url).then(response => {

      this.setState((state)=>({
        status : '完了',
        msg : response.data,
      }));
    });
  
    // 更新処理
    const url2 = "/zipcode/reactapp/address_api";
    axios.get(url2).then(response => {
      let tmp_items = response.data;

      // 分岐：データの有無
      if (tmp_items.length > 0) {
        this.setState((state)=>({
          status : '完了',
          items : tmp_items,
        }));
      }else{
        this.setState((state)=>({
          status : '完了',
          msg : 'データがありません',
          items : tmp_items,
        }));
      }
    });
    return;
  }

    
  //
  //
  // 指定したIDの要素を削除する処理
  callDeleteAction(id =-1, event){
    if(id == -1){
      alert('不正なアクセスです。');
      return;
    }
    
    this.setState((state)=>({
      status : '更新中',
      msg : '',
    }));

    // 削除処理
    const url = "/zipcode/reactapp/delete/"+id;
    axios.get(url).then(response => {

      this.setState((state)=>({
        status : '完了',
        msg : response.data,
      }));
    });
  
    // 更新処理
    const url2 = "/zipcode/reactapp/address_api";
    axios.get(url2).then(response => {
      let tmp_items = response.data;

      // 分岐：データの有無
      if (tmp_items.length > 0) {
        this.setState((state)=>({
          status : '完了',
          items : tmp_items,
        }));
      }else{
        this.setState((state)=>({
          status : '完了',
          msg : 'データがありません',
          items : tmp_items,
        }));
      }
    });
    return;
  }

  // ランダムで住所データ追加
  callRandomInsertAction(event){
    let count;
    while (1){
      count = prompt('何件のデータを追加しますか','1');
      count = Math.trunc(count);
      if (count == null) return;
      else if (isNaN(count)) prompt('文字は対応していません。');
      else if (count > 100 || count < 1) prompt('1以上100以下の数を指定して下さい。');
      else  break;
    }
    alert(count);
    this.setState((state)=>({
      status : '更新中',
      msg : '',
    }));

    // 追加処理
    const url = "/zipcode/reactapp/zipcode_api/insert_random_address/"+count;
    axios.get(url).then(response => {

      if (response.data.length > 0){
      this.setState((state)=>({
        status : '完了',
        msg : response.data,
      }));
      }else{
        this.setState((state)=>({
          status : '完了',
          msg : '追加に失敗しました',
      }));
      }

    });
  
    // 更新処理
    const url2 = "/zipcode/reactapp/address_api";
    axios.get(url2).then(response => {
      let tmp_items = response.data;

      // 分岐：データの有無
      if (tmp_items.length > 0) {
        this.setState((state)=>({
          status : '完了',
          items : tmp_items,
        }));
      }else{
        this.setState((state)=>({
          status : '完了',
          msg : 'データがありません',
          items : tmp_items,
        }));
      }
    });
    return;
  }
  
  //
  // xxxyyyy -> 〒xxx - yyyy
  // 郵便番号の書式を変換
  zipcodeSlice(str){
    if (str.length < 7) return str;
    const a = str.slice(0, 3);
    const b = '-';
    const c = str.slice(3);

    return('〒'+a + b + c);
  }

  //
  //
  // undefinedを取り除く
  removeUndefined(str){
    str = str.replace('undefined','');
    str = str.replace('undefined','');
    str = str.replace('undefined','');
    return str;
  }





render(){
  let result;
  let oldZipcode = this.state?.zipcodeItem?.zipcode;
  let existAddressData;
  let isLoading;
  
  result = ''+ this.state?.zipcodeItem?.address1 
  + this.state?.zipcodeItem?.address2 
  + this.state?.zipcodeItem?.address3;
  result = this.removeUndefined(result);


  if (result.length > 0) {
    existAddressData =false;
  }else{
    existAddressData =true;
  }

  if (this.state?.status ==='更新中'){
    isLoading = true;
  }else{
    isLoading = false;
  }

  return (
  <div className="container">
    <div className="container">
      <div className="input-group mb-3">  
        <input 
          type="text"  
          id = 'msg' 
          value = {this.state?.msg} 
          className="form-control" 
          placeholder="" 
          aria-label="msg" 
          aria-describedby="basic-addon2"
          disabled
        />
      </div>
    </div>        

    <div className="d-flex p-2 bd-highlight">
      <div className="input-group mb-3">
        <span className="input-group-text" id="basic-addon2">〒</span>
        <input 
          type="text"
          id = 'zipcode' 
          className="form-control" 
          placeholder="000-0000" 
          aria-label="zipcode" 
          aria-describedby="basic-addon2"
          maxLength="8"
          onChange={this.callZipcodeApi}
        />

        {/* <button type = 'button'  className= "btn btn-outline-success" onClick={this.callZipcodeApi}>取得</button> */}
      </div>


      <p className="arrow"> → </p>
      <div className="input-group mb-3">
        <input 
          type="text" 
          className="form-control" 
          value = {result}
          placeholder="" 
          aria-label="address" 
          aria-describedby="basic-addon2"
          disabled
          />
        <button 
          className= "btn btn-outline-success" 
          onClick={()=>this.callInsetAction(oldZipcode)}
          disabled={existAddressData||isLoading}
        >追加</button>
      </div>
    </div>

    
    <hr/>

    <div className="container">
      <div className="row">
        <div className="col-4">
        
        <a 
          type = "button"
          className= "btn btn-outline-success" 
          disabled = {isLoading}
          href = "/zipcode/reactapp/download" 
        >CSV ダウンロード</a>
        <div class="input-group mb-3">
          <button className= "btn btn-outline-secondary" 
          onClick ={this.callRandomInsertAction}
          disabled = {isLoading}
          >ランダムデータ挿入
        </button>
        </div>
        </div>


        
        <div className="col-5">
        {/* 空要素 */}
        </div>
        <div className="col-3 align-self-end">

          <div className="input-group mb-3">  
            <input 
              type="text"  
              id = 'msg' 
              value = {this.state?.status} 
              className="form-control" 
              placeholder="" 
              aria-label="msg" 
              aria-describedby="basic-addon2"
              disabled
            />

            <button 
              className= "btn btn-outline-success"
              onClick={this.getAddressData}
              disabled = {isLoading}
            >更新</button>
          </div>
        </div>
      </div> 
    </div> 
          
          
      {/* テーブル表示 */}
      <table className="table">
        <thead>
          <tr>
            <th>住所1</th>
            <th>住所2</th>
            <th>住所3</th>
            <th>かな1</th>
            <th>かな2</th>
            <th>かな3</th>
            <th>郵便番号</th>
            <th>登録日時</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          {
            this.state?.items?.map((row) => {
              return (
              <tr>
                <td>{row.address1}</td>
                <td>{row.address2}</td>
                <td>{row.address3}</td>
                <td>{row.kana1}</td>
                <td>{row.kana2}</td>
                <td>{row.kana3}</td>
                <td>{this.zipcodeSlice(row.zipcode)}</td>
                <td>{row.created_at.slice(0,10)}</td>
                <td>
                  <button className= "btn btn-outline-danger" 
                    onClick ={()=>this.callDeleteAction(row.id)}
                    disabled = {isLoading}
                    >削除
                  </button>
                </td>
              </tr>
              );
            })
          }              
        </tbody>
      </table>
    </div>
    );
  }
}


if (document.getElementById('mycomponent')) {
  ReactDOM.render(<MyComponent />,document.getElementById('mycomponent'));
}
