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

    // 初期json呼び出し
    this.getAddressData();
    this.state = {
      status : '更新中',
      msg :'',
    };
  }

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

  // zip code api呼び出し
  callZipcodeApi(event){
    this.setState((state)=>({
      status : '更新中',
      err :'',
    }));

    let zipcode1 ='' + document.getElementById('zipcode1').value;
    let zipcode2 ='' + document.getElementById('zipcode2').value;
    
    // zipcode　バリデーション
    if (zipcode1 ===''|| zipcode2 === ''){
      this.setState((state)=>({
        status : '完了',
        msg : '未入力',
      }));
      return;
    }

    let url = '/zipcode/reactapp/zipcode_api/' + zipcode1 + zipcode2;

    axios.get(url).then(response => {
      let temp_data = JSON.parse(response.data);

      // debug 用
      console.log(temp_data);


      // errorメッセージが帰ってきた場合
      if (!temp_data.message === null){
        this.setState((state)=>({
          status : '完了',
          msg : '住所の取得に失敗しました',
        }));
        return;
      }

      // リザルトが帰ってきた場合
      if(temp_data.results?.length != null) {
        this.setState((state)=>({
          status : '完了',
          zipcodeItem : temp_data,
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
  
  // 追加処理
  callInsetAction(zipcode =-1, event){
    // zipcode　バリデーション
    if (zipcode=== -1){
      this.setState((state)=>({
        status : '完了',
        msg : '未入力',
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

  // 削除処理
  callDeleteAction(id =-1, event){
    if(id == -1){
      alert('return');
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

  render(){
    let oldZipcode = this.state?.zipcodeItem?.results[0]?.zipcode;
    let result = ''+ this.state?.zipcodeItem?.results[0]?.address1 
    + this.state?.zipcodeItem?.results[0]?.address2 
    + this.state?.zipcodeItem?.results[0]?.address3;

    result = result.replace('undefined','');
    result = result.replace('undefined','');
    result = result.replace('undefined','');


      return (
      <div className="container">
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon2">〒</span>
          <input type="number"  id = 'zipcode1' class="form-control" placeholder="000" aria-label="zipcode" aria-describedby="basic-addon2"/>
          <span class="input-group-text" id="basic-addon2">-</span>
          <input type="number"  id = 'zipcode2'class="form-control" placeholder="0000" aria-label="zipcode" aria-describedby="basic-addon2"/>
          <button class= "btn btn-outline-success" onClick={this.callZipcodeApi}>取得</button>
        </div>
        <div class >
        <p class="text-center">↓</p>
        </div>
        <div class="input-group mb-3">
          <input 
            type="text" 
            class="form-control" 
            value = {result}
            placeholder="" 
            aria-label="address" 
            aria-describedby="basic-addon2"
            disabled
          />
          <button class= "btn btn-outline-success" onClick={()=>this.callInsetAction(oldZipcode)}>追加</button>
        </div>
        <hr/>
        <div className="container">
        <div class="input-group mb-3">
 
          <span class="input-group-text" id="basic-addon2">メッセージ</span>

          <input 
            type="text"  
            id = 'msg' 
            value = {this.state?.msg} 
            class="form-control" 
            placeholder="" 
            aria-label="msg" 
            aria-describedby="basic-addon2"
            disabled
          />

          
          <span class="input-group-text" id="basic-addon2">状態</span>
          <input 
            type="text"  
            id = 'msg' 
            value = {this.state?.status} 
            class="form-control" 
            placeholder="" 
            aria-label="msg" 
            aria-describedby="basic-addon2"
            disabled
          />
          <button class= "btn btn-outline-success" onClick={this.getAddressData}>更新</button>

        </div>
        
        
        {/* テーブル表示 */}
        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>address1</th>
              <th>address2</th>
              <th>address3</th>
              <th>kana1</th>
              <th>kana2</th>
              <th>kana3</th>
              <th>zipcode</th>
              <th>created_at</th>
              <th>delete</th>
            </tr>
          </thead>
          <tbody>
            {
              
              this.state?.items?.map((row) => {
                return (
                <tr>
                  <td>{row.id}</td>
                  <td>{row.address1}</td>
                  <td>{row.address2}</td>
                  <td>{row.address3}</td>
                  <td>{row.kana1}</td>
                  <td>{row.kana2}</td>
                  <td>{row.kana3}</td>
                  <td>{row.zipcode}</td>
                  <td>{row.created_at.slice(0,10)}</td>
                  <td><button class= "btn btn-outline-danger" onClick ={()=>this.callDeleteAction(row.id)}>削除</button></td>
                </tr>
                );
              })
            }              
          </tbody>
        </table>
      </div>
      </div>
    );
  }
}


if (document.getElementById('mycomponent')) {
  ReactDOM.render(<MyComponent />,document.getElementById('mycomponent'));
}
