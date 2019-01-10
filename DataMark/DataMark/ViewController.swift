//
//  ViewController.swift
//  DataMark
//
//  Created by GtyFour on 2018/12/21.
//  Copyright © 2018 GtyFour. All rights reserved.
//

import UIKit
import WebKit

class ViewController: UIViewController,WKNavigationDelegate,UIScrollViewDelegate,UIPickerViewDelegate, UIPickerViewDataSource{
    
    let docPath = NSSearchPathForDirectoriesInDomains(FileManager.SearchPathDirectory.documentDirectory, FileManager.SearchPathDomainMask.userDomainMask, true)[0] as NSString
    
    var current_page : URL!
    var mark_list : NSArray!
    
    @IBOutlet weak var pickerView:UIPickerView!
    @IBOutlet weak var webView: WKWebView!
    @IBOutlet weak var saveBtn: UIButton!
    @IBOutlet weak var chooseBtn: UIButton!
    @IBOutlet weak var decideBtn: UIButton!
    @IBOutlet weak var addBtn: UIButton!
    @IBOutlet weak var removeBtn: UIButton!
    
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }
    
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        let filePath = docPath.appendingPathComponent("data.plist");
        let dataSource = NSArray(contentsOfFile: filePath);
        if dataSource == nil {
            return 0
        }
        let count = dataSource?.count
        
        if count == 0
        {
            return 0
        }
        else{
            return count!
        }
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if isMarkExist(){
            NSLog("is Mark Exist!")
            current_page = URL(string: readExistMark())
        }else
        {
            NSLog("is NOT Mark Exist!")
            current_page = URL(string: "http://dm.trtos.com/web/datamark/index.php")
        }
        loadMainView()
        
    }
    
    @objc func saveBtnClick(){
        saveMark()
        print("点击了saveBtnClick")
    }
    
    @objc func addBtnClick(){
        var inputText:UITextField = UITextField();
        let msgAlertCtr = UIAlertController.init(title: "MarkID", message: "Paste your url", preferredStyle: .alert)
        let ok = UIAlertAction.init(title: "ok", style:.default) { (action:UIAlertAction) ->() in
            if((inputText.text) != ""){
                print("你输入的是：\(String(describing: inputText.text))")
                let add_str = String(describing: inputText.text)
                let deRange = add_str.range(of: "?id=")
                let mark_ID = String(add_str[add_str.index(deRange!.upperBound, offsetBy: 0)..<add_str.index(deRange!.upperBound, offsetBy: 8)])
                let real_urlstr = ("http://dm.trtos.com/web/datamark/index.php?id="+mark_ID)
                print(real_urlstr)
                let filePath = self.docPath.appendingPathComponent("data.plist")
                
                if NSMutableArray(contentsOfFile: filePath) == nil {
                    let dataSource = NSMutableArray()
                    dataSource.add(("http://dm.trtos.com/web/datamark/index.php?id="+mark_ID) as Any)
                    let isSuccess = dataSource.write(toFile: filePath, atomically: true)
                    isSuccess ? print("Mark写入成功") :print("Mark写入失败")
                    self.dialogOKCancel(question: mark_ID, text: "存好了！(＾－＾)")
                }else{
                    let dataSource = NSMutableArray(contentsOfFile: filePath)
                    
                    for record in dataSource! {
                        let str_rcd = record as! String
                        if str_rcd == ("http://dm.trtos.com/web/datamark/index.php?id="+mark_ID){
                            self.dialogOKCancel(question: mark_ID, text: "(⊙.⊙)存过了吖！")
                            return
                        }
                    }
                    dataSource!.add(add_str as Any)
                    let isSuccess = dataSource!.write(toFile: filePath, atomically: true)
                    isSuccess ? print("Mark写入成功") :print("Mark写入失败")
                    self.dialogOKCancel(question: "MarkID", text: "存好了！(＾－＾)")
                }
                
                //更新列表
                self.mark_list = NSMutableArray(contentsOfFile: filePath);
                self.pickerView.reloadAllComponents()
            }
        }
        let cancel = UIAlertAction.init(title: "cancle", style:.cancel) { (action:UIAlertAction) -> ()in
            print("取消输入")
        }
        msgAlertCtr.addAction(ok)
        msgAlertCtr.addAction(cancel)
        //添加textField输入框
        msgAlertCtr.addTextField { (textField) in
            //设置传入的textField为初始化UITextField
            inputText = textField
            inputText.placeholder = "http://dm.trtos.com/web/datamark/index.php?id=???????"
        }
        //设置到当前视图
        self.present(msgAlertCtr, animated: true, completion: nil)
        
        print("点击了addBtnClick")
    }
    @objc func removeBtnClick(){
        
        var inputText:UITextField = UITextField();
        let msgAlertCtr = UIAlertController.init(title: "Remove MarkID", message: "Paste your url", preferredStyle: .alert)
        let ok = UIAlertAction.init(title: "ok", style:.default) { (action:UIAlertAction) ->() in
            if((inputText.text) != ""){
                print("你输入的是：\(String(describing: inputText.text))")
                let add_str = String(describing: inputText.text)
                let deRange = add_str.range(of: "?id=")
                let mark_ID = String(add_str[add_str.index(deRange!.upperBound, offsetBy: 0)..<add_str.index(deRange!.upperBound, offsetBy: 8)])
                let add_urlstr = "http://dm.trtos.com/web/datamark/index.php?id=" + mark_ID
                let filePath = self.docPath.appendingPathComponent("data.plist")
                
                if NSMutableArray(contentsOfFile: filePath) == nil {
                    self.dialogOKCancel(question: "MarkID", text: "Nothing to remove!!")
                }else{
                    let dataSource = NSMutableArray(contentsOfFile: filePath)
                    
                    if dataSource!.count == 1{
                        self.dialogOKCancel(question: "MarkID", text: "Less one record will remind!")
                        return
                    }
                    dataSource!.remove(add_urlstr as Any)
                    
                    let isSuccess = dataSource!.write(toFile: filePath, atomically: true)
                    isSuccess ? print("Mark写入成功") :print("Mark写入失败")
                    self.dialogOKCancel(question: "MarkID", text: "删掉啦！╮(╯_╰)╭")
                }
                
                //更新列表
                self.mark_list = NSMutableArray(contentsOfFile: filePath);
                self.pickerView.reloadAllComponents()
            }
        }
        let cancel = UIAlertAction.init(title: "cancle", style:.cancel) { (action:UIAlertAction) -> ()in
            print("取消输入")
        }
        msgAlertCtr.addAction(ok)
        msgAlertCtr.addAction(cancel)
        //添加textField输入框
        msgAlertCtr.addTextField { (textField) in
            //设置传入的textField为初始化UITextField
            inputText = textField
            inputText.placeholder = "http://dm.trtos.com/web/datamark/index.php?id=???????"
        }
        //设置到当前视图
        self.present(msgAlertCtr, animated: true, completion: nil)
        
        
        print("点击了removeBtnClick")
    }
    @objc func removeBtnDoubleClick(){
        
        let deRange = webView.url?.absoluteString.range(of: "?id=")
        let mark_ID = String((webView.url?.absoluteString.suffix(from: deRange!.upperBound))!)
        
        let filePath = docPath.appendingPathComponent("data.plist")
        let dataSource = NSMutableArray()
        dataSource.add(webView.url?.absoluteString as Any)
        let isSuccess = dataSource.write(toFile: filePath, atomically: true)
        isSuccess ? print("当前Mark写入成功") :print("Mark写入失败")
        dialogOKCancel(question: mark_ID, text: "清理完毕！(~。~)")

        //更新列表
        mark_list = NSMutableArray(contentsOfFile: filePath);
        pickerView.reloadAllComponents()
        
        print("点击了removeBtnDoubleClick")
    }
    
    @objc func chooseBtnClick(){
        pickerView.isHidden = false
        decideBtn.isHidden = false
        chooseBtn.isHidden = true
        addBtn.isHidden = true
        removeBtn.isHidden = true

        print("点击了chooseBtnClick")
    }
    
    func loadMainView() {
        //读取主页面
        
        pickerView.backgroundColor = UIColor.white
        //将dataSource设置成自己
        pickerView.dataSource = self
        //将delegate设置成自己
        pickerView.delegate = self
        //设置选择框的默认值
        pickerView.selectRow(1,inComponent:0,animated:true)
        pickerView.isHidden = true
        self.view.addSubview(pickerView)
        
        decideBtn.isHidden = true
        
        saveBtn.addTarget(self, action: #selector(saveBtnClick), for: .touchUpInside)
        chooseBtn.addTarget(self, action: #selector(chooseBtnClick), for: .touchUpInside)
        addBtn.addTarget(self, action: #selector(addBtnClick), for: .touchUpInside)
        removeBtn.addTarget(self, action: #selector(removeBtnClick), for: .touchUpInside)
        removeBtn.addTarget(self, action: #selector(removeBtnDoubleClick), for: .touchDragExit)
        decideBtn.addTarget(self, action: #selector(getPickerViewValue), for: .touchUpInside)
        
        self.webView.navigationDelegate = self
        self.webView.scrollView.delegate = self
        
        
        if let htmlUrl = current_page {
            webView.load(URLRequest.init(url: htmlUrl))
        }
    }
    
    func saveMark() {
        
        let deRange = webView.url?.absoluteString.range(of: "?id=")
        let mark_ID = String((webView.url?.absoluteString.suffix(from: deRange!.upperBound))!)
        
        let filePath = docPath.appendingPathComponent("data.plist")
        
        if NSMutableArray(contentsOfFile: filePath) == nil {
            let dataSource = NSMutableArray()
            dataSource.add(webView.url?.absoluteString as Any)
            let isSuccess = dataSource.write(toFile: filePath, atomically: true)
            isSuccess ? print("Mark写入成功") :print("Mark写入失败")
            dialogOKCancel(question: mark_ID, text: "存好了！(＾－＾)")
        }else{
            let dataSource = NSMutableArray(contentsOfFile: filePath)
            
            for record in dataSource! {
                let str_rcd = record as! String
                if str_rcd == webView.url?.absoluteString{
                    dialogOKCancel(question: mark_ID, text: "(⊙.⊙)存过了吖！")
                    return
                }
            }
            dataSource!.add(webView.url?.absoluteString as Any)
            let isSuccess = dataSource!.write(toFile: filePath, atomically: true)
            isSuccess ? print("Mark写入成功") :print("Mark写入失败")
            dialogOKCancel(question: mark_ID, text: "存好了！(＾－＾)")
        }

        //更新列表
        mark_list = NSMutableArray(contentsOfFile: filePath);
        pickerView.reloadAllComponents()
    }
    
    func isMarkExist()->Bool {
        let filePath = docPath.appendingPathComponent("data.plist");
        let dataSource = NSMutableArray(contentsOfFile: filePath);
        if dataSource == nil {
            print("data.plist nill!")
             return false
        }
        let count = dataSource?.count
        if count == 0
        {
            print("data.plist's count ZERO!")
            return false
        }
        else{
            print("data.plist succ!")
            return true
        }
        
    }
    
    func readExistMark()->String {
        let filePath = docPath.appendingPathComponent("data.plist");
        let dataSource = NSMutableArray(contentsOfFile: filePath);
        mark_list = NSMutableArray(contentsOfFile: filePath);
        let url =  dataSource?[0] as! String
        return url
    }
    
    //设置选择框各选项的内容，继承于UIPickerViewDelegate协议
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int,
                    forComponent component: Int) -> String? {
        let str  = mark_list.object(at: row) as? String
        let deRange = str!.range(of: "?id=")
//        let mark_ID = String(str!.suffix(from: deRange!.upperBound))
//        let mark_ID = String(str!.formIndex(deRange!.upperBound, offsetBy: 8))
//        let mark_ID = String(str![..<str!.index(deRange!.upperBound, offsetBy: 8)])
        let mark_ID = String(str![str!.index(deRange!.upperBound, offsetBy: 0)..<str!.index(deRange!.upperBound, offsetBy: 8)])

        return mark_ID
    }
    
    //触摸按钮时，获得被选中的索引
    @objc func getPickerViewValue(){
        print("点击了decideBtnClick")
        pickerView.isHidden = true
        decideBtn.isHidden = true
        chooseBtn.isHidden = false
        addBtn.isHidden = false
        removeBtn.isHidden = false
        let picker_num = pickerView.selectedRow(inComponent: 0)
        print(picker_num)
        let picker_url = mark_list.object(at: picker_num) as? String
        print(picker_url)
        current_page = URL(string: picker_url!)
        print(current_page)
        if let htmlUrl = current_page {
            webView.load(URLRequest.init(url: htmlUrl))
        }
    }
    
    func dialogOKCancel(question: String, text: String){
        let alert_view = UIAlertView()
        alert_view.title = question
        alert_view.message = text
        alert_view.addButton(withTitle: "好的")
        alert_view.addButton(withTitle: "取消")
        alert_view.cancelButtonIndex=0
        alert_view.delegate=self;
        alert_view.show()
    }
    
}

