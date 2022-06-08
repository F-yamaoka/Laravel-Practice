import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';

export default class MyComponent extends Component {
  constructor(props){
    super(props);

    this.getAddressData = this.getAddressData.bind(this);
    this.callZipcodeApi = this.callZipcodeApi.bind(this);

    // 初期json呼び出し
    this.getAddressData();
    this.state = {
      msg : '更新中',
      err :'',
    };
  }

  callZipcodeApi(event){
    this.setState((state)=>({
      msg : '更新中',
      err :'',

    }));

      // 仮　デ　ー　タ　仮　デ　ー　タ　　
    let zipcode1 ='' + document.getElementById('zipcode1').value;
    let zipcode2 ='' + document.getElementById('zipcode2').value;

    if (zipcode1 ===''|| zipcode2 === ''){
      this.setState((state)=>({
        msg : '完了',
        err : '未入力',
      }));
      return;
    }
    let url = '/zipcode/reactapp/zipcode_api/' + zipcode1 + zipcode2;

    axios.get(url).then(response => {
      let temp_data = JSON.parse(response.data);

      // errorメッセージが帰ってきた場合
      if (!temp_data.message === null){
        this.setState((state)=>({
          msg : '完了',
          err : '住所の取得に失敗しました(' + temp_data.message + ')',
        }));
        return;
      }

      // debug 用
      console.log(temp_data);


      // リザルトが帰ってきた場合
      if(temp_data.results?.length != null) {
        this.setState((state)=>({
          msg : '完了',
          zipcodeItem : temp_data,
        }));
        return;
      }

      // 何も帰ってこなかった場合
      this.setState((state)=>({
        msg : '完了',
        err : '住所の取得に失敗しました(不明なエラー)' 
      }));
    });
  }
  
  // JSON取得 表に成形
  getAddressData(event){
    this.setState((state)=>({
      msg : '更新中',
      err : '',
    }));
    const url = "/zipcode/reactapp/address_api";
    axios.get(url).then(response => {
      let tmp_items = response.data;

      // 分岐：データの有無
      if (tmp_items.length > 0) {
        this.setState((state)=>({
          msg : '完了',
          items : tmp_items,
          err :'',
        }));
      }else{
        this.setState((state)=>({
          msg : '完了',
          err : 'データの更新に失敗しました。',
        }));
      }
    });
  }

  render(){
    return (
      <div className="container">
        <p>result:{this.state?.zipcodeItem?.results[0]?.zipcode} {this.state?.zipcodeItem?.results[0]?.addresse}
        {this.state?.zipcodeItem?.results[0]?.address2}{this.state?.zipcodeItem?.results[0]?.address3}</p>
        <p>err:{this.state?.err}</p>
        <p>msg:{this.state?.msg}</p>

        <p>zipcode1 :<input type ='number' id = 'zipcode1'/></p>
        <p>zipcode2 :<input type ='number' id = 'zipcode2'/></p>

        <p><button onClick={this.callZipcodeApi}>取得</button></p> 
        <p><button onClick={this.getAddressData}>更新</button></p> 
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