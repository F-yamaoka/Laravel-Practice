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
    this.returnTop = this.returnTop(this);



    this.state = {
      name : 'testname', // 今後はログイン名に変える
      status : '更新中',
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



    this.setState((state)=>({
      name : 'testname2',
      status : '完了',
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
    name: this.state.name,
    context: context
    })
    .then(function (response) {
      console.log(response);
    })
    
    const url = "/chatapp/get";
    axios.get(url).then(response => {
      console.log(response.data);
      this.setState((state)=>({
        status : '完了',
        items : response.data,
      }));
    });
    }
    document.getElementById('context').value = '';
  }


  //
  //
  // ロードFlag
  isLoading(state){
    return (this.state.status == '更新中');
  }

  //
  //
  // 自分の投稿かどうか
  isMine(myname, state){
    return (myname == this.state.name);
  }

  //
  //
  // 日付変換　時間のみ表示
  convertDate(created_at){
    let hour = created_at.slice(11,13);
    let min = created_at.slice(14,16);

    // 日本時間に変換 (MySQLの時間設定が変えられないので暫定処理)
    let time_difference = 9; // 時差 (JST - UTC)
    hour = Number(hour);
    hour += time_difference;
    if (hour > 24) {
      hour = hour - 24;
    }
    if (hour < 10)hour = '0' + hour;
    //
    
    return(hour +':'+ min);
  }

  //
  //
  // トップに戻る
  returnTop(state){
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  };

  //
  //
  // レンダリング
  render(){

    return (
      <div className="container">

        <div className="background1" id = "background1">
        {this.state?.items?.map((row) => {
        return (
          <div>
          <div className={(this.isMine(row.name) ?"rightmessagebox":"leftmessagebox")}>
            <div  className={(this.isMine(row.name) ?"rightboxlavel":"leftboxlavel")}>{row.name}</div>
          </div>
          <div className={(this.isMine(row.name) ?"rightmessagebox":"leftmessagebox")}>
            <div className={(this.isMine(row.name) ?"rightbox":"leftbox")}>{row.context}</div>
            <div  className={(this.isMine(row.name) ?"rightboxdate":"leftboxdate")}>{this.convertDate(row.created_at)}</div>
          </div>
          </div>
        );})}
        </div>

        <div className="background2"> 
          <div className="input-group mb-3">
          <textarea className="form-control" id = 'context' rows="1" placeholder="メッセージ"></textarea>
          <button onClick={this.sendMessage} className ="btn btn-primary" >送信</button>
          </div>
        </div>

      </div>
    )
  }
}
/* 
送信や更新でページを一番下に移動する
メッセージに日付と送信者の名前を表示する
テキストエリアを文字数によって大きさが変わるようにする
送信者の名前を自由に変えられるようにする
すべてロードするのではなく、日付の新しいものだけロードする
 */
if (document.getElementById('ChatApp')) {
  ReactDOM.render(<ChatApp/>,document.getElementById('ChatApp'));
}
