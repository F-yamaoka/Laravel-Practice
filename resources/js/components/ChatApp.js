import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';

export default class ChatApp extends Component {
  constructor(props){
    super(props);
    this.reloadMessage();

    // 名前変更
    this.namechange = this.namechange.bind(this);
    // メッセージをリロードする。
    this.reloadMessage = this.reloadMessage.bind(this);
    // メッセージを送信する。
    this.sendMessage = this.sendMessage.bind(this);
    // ロードFlag
    this.isLoading = this.isLoading.bind(this);
    this.isMine = this.isMine.bind(this);


    this.state = {
      name : 'testname',
      status : '更新中',
      msg :'testmessage',
    };
  }

  //
  //
  // 名前変更
  namechange(state){
    this.setState((state)=>({
      name : 'testname2',
      status : '更新中',
      msg :'',
    }));
  }

  //
  //
  // メッセージをリロードする。
  reloadMessage(state){
    // 更新処理
    const url = "/chatapp/get";
    axios.get(url).then(response => {
      console.log(response.data);
      this.setState((state)=>({
        status : '完了',
        items : response.data,
      }));
    });
    


  }
  
  //
  //
  // メッセージを送信する。
  sendMessage(state){
    let context = document.getElementById('context').value;
    if (context.length > 0){
    axios.post('/chatapp/send', {
    name: 'testname',
    context: context
    })
    .then(function (response) {
      console.log(response);
    })

    // 更新して最下部までスクロール

    document.getElementById('context').value = '';
    }
  }


  //
  //
  // ロードFlag
  isLoading(state){
    return (this.state.status == '更新中');
  }

  //
  //
  // ロードFlag
  isMine(myname, state){
    return (myname == this.state.name);
  }


  //
  //
  // レンダリング
  render(){
    return (
      <div className="container">

        <div className="background1" id = "background1">
        {this.state?.items?.map((row) => {
        return (
          <ul >
            <li  className={(this.isMine(row.name) ?"rightbox":"leftbox")}>{row.context}</li>
          </ul>  
          );})}
        </div>

        <div className="background2"> 
          <div className="input-group mb-3">
          <input type ='text' id = 'context' className ="form-control" placeholder="メッセージ"/>
          <button onClick={this.sendMessage} className ="btn btn-primary">送信</button>
          </div>
        </div>

      </div>
    )
  }
}

if (document.getElementById('ChatApp')) {
  ReactDOM.render(<ChatApp/>,document.getElementById('ChatApp'));
}
