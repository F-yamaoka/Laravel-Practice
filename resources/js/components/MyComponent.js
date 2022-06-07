import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';

export default class MyComponent extends Component {
  constructor(props){
    super(props);

    // 初期json呼び出し
    this.state = {
      msg : '正しく読み込まれました!',
      items :[],
    };
    this.getAddressData = this.getAddressData.bind(this);
    this.getAddressData();

  }

  // json取得 表に成形
  getAddressData(event){
    console.log('getaddressdata');
    const url = "/zipcode/address";
    axios.get(url).then(response => {
      let tmp_items = response.data;
      this.setState((state)=>({
        msg : '正しく読み込まれました！',
        items : tmp_items,
      }));
      /* 
      for (let i = 0; i < res.data.length; i++) {
        res.data[i]['id'];
        res.data[i]['address1'];
        res.data[i]['address2'];
        res.data[i]['address3'];
        res.data[i]['kana1'];
        res.data[i]['kana2'];
        res.data[i]['kana3'];
        res.data[i]['zipcode'];
        res.data[i]['created_at'];
      } 
      */

    });
  }

  render(){
    console.log('1');
    console.log(this.state.items);
    console.log('2');
    if (this.state.items.length > 0) {
      return (
        <div className="container">
          <p>{this.state.msg}</p>
          <p><button onClick={this.getAddressData}>更新</button></p> 

          {/* ここをfor文章で回して表を作る */}
          <p>{this.state.items[0].address1}</p>
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