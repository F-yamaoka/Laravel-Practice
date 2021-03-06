import { withThemeCreator } from "@material-ui/styles";
import axios from "axios";
import React, {Component} from "react";
import ReactDOM from 'react-dom';
export default class ChatApp extends Component {
  constructor(props){
    
    super(props);
    this.state = {
      name : 'noname', // 未ログイン時の名前
      page : 20,
    };

    // pusher
    Pusher.logToConsole = true;
    this.pusher = new Pusher("786b94b8b8578e9b2e5e", {
      cluster: 'ap3'
    });
    this.channel = this.pusher.subscribe('my-channel');


    this.node = React.createRef();
    this.reloadMessage();
    this.reloadMessage = this.reloadMessage.bind(this);
    this.sendMessage = this.sendMessage.bind(this);
    this.isMine = this.isMine.bind(this);
    this.handleScroll = this.handleScroll.bind(this);

  }

  //
  //
  // 名前変更
  login(state){
    let input_name;
    while (1){
      input_name = prompt('名前を入力','');
      if (input_name == null) return;
      if (input_name == 'noname') alert('この名前は使用できません');
      else if (input_name.length > 20) alert('20文字以下で入力してください');
      else if (input_name.length == 0);
      else  break;
    }
    this.setState((state)=>({
      name : input_name,
      
    }));
  }

  logout(state){
    this.setState((state)=>({
      name : 'noname',
    }));
  }

  //
  //
  // メッセージをリロードする。
  reloadMessage(state){
    // 更新処理
    const url = "/chatapp/get";
    axios.get(url).then(response => {
      if (response.data.length > 0){
        this.setState((state)=>({
          status : '完了',
          items : response.data,
        }));
        console.log(response.data);
        // ページ最下部へ移動
        let target = document.getElementById('scroll-inner');
        target.scrollIntoView(false);
      }
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
    })
    
    axios.get('/pusher/hello-world');

    const url = "/chatapp/get";
    axios.get(url).then(response => {
      this.setState((state)=>({
        status : '完了',
        items : response.data,
      }));
      // ページ最下部へ移動
      let target = document.getElementById('scroll-inner');
      target.scrollIntoView(false);
    });
    }
    document.getElementById('context').value = '';

  }

  handleKeyDown(e,state) {
    if (e.keyCode === 13) {
      if (e.ctrlKey) {
      let context = document.getElementById('context').value;
      if (context.length > 0){
      axios.post('/chatapp/send', {
      name: this.state.name,
      context: context
      })
      .then(function (response) {
      })
      
      const url = "/chatapp/get";
      axios.get(url).then(response => {
        this.setState((state)=>({
          status : '完了',
          items : response.data,
        }));
        // ページ最下部へ移動
        let target = document.getElementById('scroll-inner');
        target.scrollIntoView(false);
      });
      }
      axios.get('/pusher/hello-world');

      e.preventDefault();
      document.getElementById('context').value = '';
    }

    }

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
  //ページの一番上に触ったとき
  // メッセージを10件追加して取ってくる。
  handleScroll(state){
    if (this.node.current.scrollTop == 0){
      let client_h = document.getElementById('background1').clientHeight;
      let scrollHeight  = document.getElementById('background1').scrollHeight; 

      let next_page_hight = scrollHeight + client_h;
      console.log('page:'+this.state.page);
      console.log('[1]clientHeight: '+client_h+' , '+scrollHeight);
      console.log('[1]'+(next_page_hight));


      let next_page = this.state.page;
      const url = "/chatapp/get/"+this.state.page;
      axios.get(url).then(response => {

        if (response.data.length > 0){
          this.setState((state)=>({
            status : '完了',
            items : response.data,
            page : next_page + 10,
          }));
        }
      });
      this.node.current.scrollTop = 20;

    }

  }

  //
  //
  // レンダリング
  render(){
    this.channel.bind('my-event', (data) =>{
      this.reloadMessage();

    });

    if (this.state.name == 'noname'){
      return (
        <div className="chat_container" >
            <div className="background0" id = "background0">
              <div className="d-flex justify-content-between">
              <div className="p-2 bd-highlight"><div className = 'header_msg'>ログインしていません。</div></div>
              <div className="p-2 bd-highlight"><button className ="btn btn-primary btn-sm" onClick={()=>this.login()}>ログイン</button></div>
              </div>
            </div>
            
            <div className="background1" id = "background1" onScroll={this.handleScroll} ref={this.node}>
            <div className="scroll" >
            <div id="scroll-inner" >
            <div className="d-flex flex-column-reverse bd-highlight">
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
              </div>
            </div>
          </div>
  
          <div className="background2"> 
            <div className="input-group mb-3">
            <textarea className="form-control" id = 'context' rows="1" disabled placeholder="ログインしてメッセージを送信"  
            ></textarea>
            <button className ="btn btn-primary"  disabled>送信</button>
            </div>
          </div>
                
        </div>
        )
      }else{
      return (
        <div className="chat_container">
            <div className="background0" id = "background0">
              <div className="d-flex justify-content-between">
                <div className="p-2 bd-highlight"><div className = 'header_msg'> {this.state.name}としてログイン中。</div></div>
                <div className="p-2 bd-highlight"><button className ="btn btn-danger btn-sm" onClick={()=>this.logout()}>ログアウト</button></div>
              </div>
            </div>
            <div className="background1" id = "background1" onScroll={this.handleScroll} ref={this.node}>
            <div className="scroll">
            <div id="scroll-inner">
            <div className="d-flex flex-column-reverse bd-highlight">

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
            </div>
            </div>
          </div>

          <div className="background2"> 
            <div className="input-group mb-3">
            <textarea className="form-control" id = 'context' rows="1" placeholder="メッセージ"  
            onKeyDown={
              (e) => this.handleKeyDown(e)
              }
            ></textarea>
            <button onClick={this.sendMessage} className ="btn btn-primary" >送信</button>
            </div>
          </div>
        </div>
      )
    }
  }
}


  

if (document.getElementById('ChatApp')) {
  ReactDOM.render(<ChatApp/>,document.getElementById('ChatApp'));
}
