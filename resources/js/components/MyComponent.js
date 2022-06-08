import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';

export default class MyComponent extends Component {
  constructor(props){
    super(props);

    // 初期json呼び出し
    this.getAddressData = this.getAddressData.bind(this);
    this.getAddressData();
    this.state = {
      msg : '更新中',
      items :[],
    };
  }

  // json取得 表に成形
  getAddressData(event){
    this.setState((state)=>({
      msg : '更新中',
    }));
    const url = "/zipcode/address";
    axios.get(url).then(response => {
      let tmp_items = response.data;
      if (tmp_items.length > 0) {
        this.setState((state)=>({
          msg : '正しく表示されました。',
          items : tmp_items,
        }));
      }else{
        this.setState((state)=>({
          msg : 'データの更新に失敗しました。',
        }));
      }
    });
  }

  render(){
    if (this.state.items.length > 0) {
      return (
        <div className="container">
          <p>{this.state.msg}</p>
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
        {this.state.items.map((row) => {
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
        })}
      </tbody>
    </table>
        </div>
      );
    }else{
      return (
        <div className="container">
          <p>{this.state.msg}</p>
          <p><button onClick={this.getAddressData}>更新</button></p> 
          <p></p>
        </div>
      );
    }
    

  }
}

if (document.getElementById('mycomponent')) {
  ReactDOM.render(<MyComponent />,document.getElementById('mycomponent'));
}