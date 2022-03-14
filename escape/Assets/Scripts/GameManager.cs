using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class GameManager : MonoBehaviour {

    //定数定義:壁方向
    public const int WALL_FRONT = 1;
    public const int WALL_RIGHT = 2;
    public const int WALL_BACK = 3;
    public const int WALL_LEFT = 4;
    public const int WALL_Obama = 5;
    public const int WALL_Light = 6;
    public const int WALL_Key = 7;
    public const int WALL_Pc = 8;
    public const int WALL_Display = 9;
    public const int WALL_Deskopen = 10;
    public const int WALL_Notputparts = 11;
    public const int WALL_FallObama = 12;
    public const int WALL_Bed = 20;
    public const int WALL_Bedclose = 21;
    public const int WALL_Bedopen = 22;
    public const int WALL_Air = 23;
    public const int WALL_Goal = 24;
    public const int WALL_Rimo = 25;
    public const int WALL_Rimozoom = 26;
    public const int WALL_Drum = 31;
    public const int WALL_Door = 40;
    public const int WALL_Hint2 = 41;


    //トリックで変わる
    public GameObject BeforeKey;
    public GameObject ImageAfterKey;
    public GameObject ImagePutParts;
    public GameObject ImagePcOn;
    public GameObject ButtonObama;
    public GameObject ButtonFallObama;
    public GameObject ButtonZoomScore;
    public GameObject ButtonUseBattery;
    public GameObject ImagePw;
    public GameObject ButtonPw2;
    public GameObject ImagePcYoko;
    public GameObject ButtonUseDriver;
    public GameObject ImageNotPutParts;
    public GameObject ButtonUseParts;
    public GameObject ImageFallBattery;
    public GameObject ButtonSinsetu;
    public GameObject ButtonSinsetuIMG;
    public GameObject ImageCodeNo;
    public GameObject ImageOpenDesk;
    public GameObject ImageTana;
    public GameObject ImagePutBattery;
    public GameObject ImageTurnOn;

    //UI
    public GameObject panelWalls;
    public GameObject RLbutton;
    public GameObject ButtonBack;


    //落ちてるアイテム
    public GameObject ButtonBall;
    public GameObject ButtonDriver;
    public GameObject ButtonParts;
    public GameObject ButtonBattery;


    //アイテム覧ボタン
    public GameObject ButtonItemBall;
    public GameObject ButtonItemDriver;
    public GameObject ButtonItemKey;
    public GameObject ButtonItemParts;
    public GameObject ButtonItemBattery;
    public GameObject ButtonItemPw;


    //アイテムズーム
    public GameObject ItemZoom1;
    public GameObject ItemZoom2;
    public GameObject ItemZoom3;
    public GameObject ItemZoom4;
    public GameObject ItemZoom5;
    public GameObject ItemZoom6;


    //タップしたとき赤くなる
    public GameObject ImageTrue1;
    public GameObject ImageTrue2;
    public GameObject ImageTrue3;
    public GameObject ImageTrue4;
    public GameObject ImageTrue5;
    public GameObject ImageTrue6;


    //使ったused
    public GameObject ImageUsed1;
    public GameObject ImageUsed2;
    public GameObject ImageUsed3;
    public GameObject ImageUsed4;
    public GameObject ImageUsed5;
    public GameObject ImageUsed6;

    //音

    //ドラム
    public AudioClip snare;
    public AudioClip tom1;
    public AudioClip tom2;
    public AudioClip tom3;
    public AudioClip hihat;
    public AudioClip cymbal1;
    public AudioClip cymbal2;
    public AudioClip cymbal3;
    public AudioClip bass;

    //
    public AudioClip key1;
    public AudioClip key2;
    public AudioClip lightbt;
    public AudioClip bed;
    public AudioClip gatya;
    public AudioClip code;
    public AudioClip door;

    


    //UI音
    public AudioClip pi;
    public AudioClip get;

    private AudioSource audioSource;


    public GameObject ButtonMessage;
    public GameObject ButtonMesageText;

    public GameObject KETA1;
    public GameObject KETA2;
    public GameObject KETA3;
    public GameObject KETA4;

    private int wallNo;

    // Use this for initialization
    void Start() {
        wallNo = WALL_FRONT;

        audioSource = this.gameObject.GetComponent<AudioSource>();
    }

    // Update is called once per frame
    void Update() {

    }

    //右ボタンを押した
    public void PushButtonRight()
    {
        wallNo++;
        if (wallNo > WALL_LEFT)
        {
            wallNo = WALL_FRONT;
        }
        DisplayWall();
    }

    //左ボタンを押した
    public void PushButtonLeft() {
        wallNo--;
        if (wallNo < WALL_FRONT)
        {
            wallNo = WALL_LEFT;
        }
        DisplayWall();
    }

    //下ボタンを押した
    public void PushButtonBack()
    {
        if (wallNo <= 19)
        {
            wallNo = 1;
        }
        else if ((wallNo >= 20) && (wallNo <= 29))
        {
            wallNo = 2;
        }
        else if ((wallNo >= 30) && (wallNo <= 39))
        {
            wallNo = 3;
        }
        else
        {
            wallNo = 4;
        }
        ButtonBack.SetActive(false);
        RLbutton.SetActive(true);
        DisplayWall();
    }

    //向いてる方向の壁を表示
    void DisplayWall() {
        switch (wallNo) {
            case WALL_FRONT:
                panelWalls.transform.localPosition = new Vector3(0.0f, 0.0f, 0.0f);
                break;
            case WALL_RIGHT:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, 0.0f, 0.0f);
                break;
            case WALL_BACK:
                panelWalls.transform.localPosition = new Vector3(-2000.0f, 0.0f, 0.0f);
                break;
            case WALL_LEFT:
                panelWalls.transform.localPosition = new Vector3(-3000.0f, 0.0f, 0.0f);
                break;
            //scene1
            case WALL_Obama:
                panelWalls.transform.localPosition = new Vector3(0.0f, -1500.0f, 0.0f);
                break;
            case WALL_Light:
                panelWalls.transform.localPosition = new Vector3(0.0f, -3000.0f, 0.0f);
                break;
            case WALL_Key:
                panelWalls.transform.localPosition = new Vector3(0.0f, -4500.0f, 0.0f);
                break;
            case WALL_Pc:
                panelWalls.transform.localPosition = new Vector3(0.0f, -6000.0f, 0.0f);
                break;
            case WALL_Display:
                panelWalls.transform.localPosition = new Vector3(0.0f, -7500.0f, 0.0f);
                break;
            case WALL_Deskopen:
                panelWalls.transform.localPosition = new Vector3(0.0f, -9000.0f, 0.0f);
                break;
            case WALL_Notputparts:
                panelWalls.transform.localPosition = new Vector3(0.0f, -10500.0f, 0.0f);
                break;
            case WALL_FallObama:
                panelWalls.transform.localPosition = new Vector3(0.0f, -12000.0f, 0.0f);
                break;
            //scene2
            case WALL_Bed:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -1500.0f, 0.0f);
                break;
            case WALL_Air:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -3000.0f, 0.0f);
                break;
            case WALL_Goal:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -4500.0f, 0.0f);
                break;
            case WALL_Bedclose:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -6000.0f, 0.0f);
                break;
            case WALL_Bedopen:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -1500.0f, 0.0f);
                break;
            case WALL_Rimo:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -9000.0f, 0.0f);
                break;
            case WALL_Rimozoom:
                panelWalls.transform.localPosition = new Vector3(-1000.0f, -7500.0f, 0.0f);
                break;
            //scene3
            case WALL_Drum:
                panelWalls.transform.localPosition = new Vector3(-2000.0f, -1500.0f, 0.0f);
                break;
            //scene4
            case WALL_Door:
                panelWalls.transform.localPosition = new Vector3(-3000.0f, -1500.0f, 0.0f);
                break;
            case WALL_Hint2:
                panelWalls.transform.localPosition = new Vector3(-3000.0f, -3000.0f, 0.0f);
                break;
        }
    }
    //Scene1
    //オバマ押した
    public void PushButtonObama()
    {
        wallNo = WALL_Obama;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //電気押した
    public void PushButtonLight()
    {
        wallNo = WALL_Light;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //鍵押した
    public void PushButtonKey()
    {
        wallNo = WALL_Key;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //パソコン押した
    public void PushButtonPc()
    {
        wallNo = WALL_Pc;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //ディスプレイ押した
    public void PushButtonDisplay()
    {
        wallNo = WALL_Display;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //落ちたオバマ押した
    public void PUshButtonFallObama()
    {
        wallNo = WALL_FallObama;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //上のオバマ押した
    public void PushTopObama()
    {
        DisplayMessage("ギリギリの所にあるが、高くて取れない");
    }

    //Scene2
    //ベッド押した
    public void PushButtonBed()
    {
        wallNo = WALL_Bed;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //エアコン押した
    public void PushButtonAir()
    {
        wallNo = WALL_Air;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //ゴール押した
    public void PushButtonGoal()
    {
        wallNo = WALL_Goal;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //ベッド閉じ押した
    public void PushButtonBedClose()
    {
        audioSource.PlayOneShot(bed);
        wallNo = WALL_Bedclose;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //ベッド開き押した
    public void PushButtonBedOpen()
    {
        audioSource.PlayOneShot(bed);
        wallNo = WALL_Bedopen;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //リモコン押した
    public void PushButtonRimo()
    {
        wallNo = WALL_Rimo;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //表リモコン押した
    public void PushButtonOmoteRimo()
    {
        wallNo = WALL_Rimozoom;
        DisplayWall();
    }

    //裏リモコン押した
    public void PushButtonUraRimo()
    {
        wallNo = WALL_Rimo;
        DisplayWall();
    }

    //落ちたヒント押した
    public void PushButtonPw2()
    {
        getPw();
    }

    //エアコンヒント押した
    public void PushButtonPw()
    {
        DisplayMessage("何か挟まっているが取れない");
    }

    //scene3
    //ドラム押した
    public void PushButtonDrum()
    {
        wallNo = WALL_Drum;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //楽譜押した
    public void PushButtonScore()
    {
        ButtonZoomScore.SetActive(true);
    }

    //ズーム楽譜押した
    public void PushButtonZoomScore()
    {
        ButtonZoomScore.SetActive(false);
    }

    //親切ボタン押した
    public void PushButtonSinsetu()
    {
        ButtonSinsetuIMG.SetActive(true);
    }

    //ズーム親切ボタン押した
    public void PushButtonSinsetyZoom()
    {
        ButtonSinsetuIMG.SetActive(false);
    }

    //scene4
    //ドア押した
    public void PushButtonDoor()
    {
        wallNo = WALL_Door;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }

    //ヒント２押した
    public void PushButtonHint2()
    {
        wallNo = WALL_Hint2;
        DisplayWall();
        RLbutton.SetActive(false);
        ButtonBack.SetActive(true);
    }






    //////////アイテム関係////////
    int itemNo = 0;
    int howmanytap = 0;
    int howmanytap2 = 0;
    int keta1 = 0;
    int keta2 = 0;
    int keta3 = 0;
    int keta4 = 0;
    int kari = 0;

    string strketa1;
    string strketa2;
    string strketa3;
    string strketa4;

    public bool tapball = false;
    public bool tapdriver = false;
    public bool tapkey = false;
    public bool tapparts = false;
    public bool tapbattery = false;
    public bool tappw = false;

    public bool getball = false;
    public bool getdriver = false;
    public bool getkey = false;
    public bool getparts = false;
    public bool getbattery = false;
    public bool getpw = false;
    public bool getcode = false;

    public bool usedball = false;
    public bool useddriver = false;
    public bool usedkey = false;
    public bool usedparts = false;
    public bool usedbattery = false;
    public bool usedpw = false;

    public bool pcOn = false;
    public bool putBattery = false;







    //ボール押した
    public void PushButtonBall()
    {
        audioSource.PlayOneShot(get);
        itemNo++;
        itemDisplay(1);
        itemzoomDisplay(1);
        ButtonBall.SetActive(false);
    }

    //ドライバー押した
    public void PushButtonDriver()
    {
        audioSource.PlayOneShot(get);
        itemNo++;
        itemDisplay(2);
        itemzoomDisplay(2);
        ButtonDriver.SetActive(false);
    }

    //鍵ゲット
    public void getKey()
    {
        audioSource.PlayOneShot(get);
        itemNo++;
        itemDisplay(3);
        itemzoomDisplay(3);
        DisplayMessage("カギが落ちてきた");
        usedball = true;
        ImageUsed1.SetActive(true);
    }

    //部品ゲット
    public void PushButtonParts()
    {
        audioSource.PlayOneShot(get);
        itemNo++;
        itemDisplay(4);
        itemzoomDisplay(4);
        DisplayMessage("パソコンの部品だ");
        ButtonParts.SetActive(false);
        BeforeKey.SetActive(false);
        ImageAfterKey.SetActive(true);
        ImageOpenDesk.SetActive(true);
        ImageTana.SetActive(false);
        pcOn = true;
    }

    //バッテリーゲット
    public void PushButtonBattery()
    {
        audioSource.PlayOneShot(get);
        itemNo++;
        itemDisplay(5);
        itemzoomDisplay(5);
        //ButtonFallObama.SetActive(false);
        ButtonBattery.SetActive(false);
        ImageFallBattery.SetActive(false);
    }

    //ヒントゲット
    public void getPw()
    {
        audioSource.PlayOneShot(get);
        itemNo++;
        itemDisplay(6);
        itemzoomDisplay(6);
        DisplayMessage("挟まっていた紙が落ちてきた");
        ButtonPw2.SetActive(false);
        getpw = true;
    }

    //コード番号ゲット
    public void getCodeno()
    {
        ImageCodeNo.SetActive(true);
        getcode = true;

    }


    void tapoff()
    {
        tapball = false;
        tapdriver = false;
        tapkey = false;
        tapparts = false;
        tapbattery = false;
        tappw = false;
        ImageTrue1.SetActive(false);
        ImageTrue2.SetActive(false);
        ImageTrue3.SetActive(false);
        ImageTrue4.SetActive(false);
        ImageTrue5.SetActive(false);
        ImageTrue6.SetActive(false);
    }

    //アイテム覧ボール
    public void PushButtonItemBall()
    {
        if (usedball == false)
        {
            if (tapball == false)
            {
                audioSource.PlayOneShot(pi);
                tapoff();
                tapball = true;
                ImageTrue1.SetActive(true);
            }
            else
            {
                itemzoomDisplay(1);
                tapoff();

            }
        }
        else
        {

        }
    }

    //アイテム覧ドライバー
    public void PushButtonItemDriver()
    {
        if (useddriver == false)
        {
            if (tapdriver == false)
            {
                audioSource.PlayOneShot(pi);
                tapoff();
                tapdriver = true;
                ImageTrue2.SetActive(true);
            }
            else
            {
                itemzoomDisplay(2);
                tapoff();

            }
        }
        else
        {

        }
    }

    //アイテム覧カギ
    public void PushButtonItemKey()
    {
        if (usedkey == false)
        {
            if (tapkey == false)
            {
                audioSource.PlayOneShot(pi);
                tapoff();
                tapkey = true;
                ImageTrue3.SetActive(true);
            }
            else
            {
                itemzoomDisplay(3);
                tapoff();

            }
        }
        else
        {

        }
    }

    //アイテム覧パーツ
    public void PushButtonItemParts()
    {
        if (usedparts == false)
        {
            if (tapparts == false)
            {
                audioSource.PlayOneShot(pi);
                tapoff();
                tapparts = true;
                ImageTrue4.SetActive(true);
            }
            else
            {
                itemzoomDisplay(4);
                tapoff();
            }
        }
        else
        {

        }
    }

    //アイテム覧バッテリー
    public void PushButtonItemBattery()
    {
        if (usedbattery == false)
        {
            if (tapbattery == false)
            {
                audioSource.PlayOneShot(pi);
                tapoff();
                tapbattery = true;
                ImageTrue5.SetActive(true);
            }
            else
            {
                itemzoomDisplay(5);
                tapoff();
            }
        }
        else
        {

        }
    }

    //アイテム覧ヒント
    public void PushButtonItemPw()
    {
        if (usedpw == false)
        {
            if (tappw == false)
            {
                audioSource.PlayOneShot(pi);
                tapoff();
                tappw = true;
                ImageTrue6.SetActive(true);
            }
            else
            {
                itemzoomDisplay(6);
                tapoff();

            }
        }
        else
        {

        }
    }

    //アイテム押した時ズームされる処理
    void itemzoomDisplay(int itemName)
    {
        switch (itemName)
        {
            case 1:
                ItemZoom1.SetActive(true);
                break;
            case 2:
                ItemZoom2.SetActive(true);
                break;
            case 3:
                ItemZoom3.SetActive(true);
                break;
            case 4:
                ItemZoom4.SetActive(true);
                break;
            case 5:
                ItemZoom5.SetActive(true);
                break;
            case 6:
                ItemZoom6.SetActive(true);
                break;
        }
    }

    //ズームOFF
    public void ButtonItemZoom1()
    {
        ItemZoom1.SetActive(false);
    }

    public void ButtonItemZoom2()
    {
        ItemZoom2.SetActive(false);
    }

    public void ButtonItemZoom3()
    {
        ItemZoom3.SetActive(false);
    }

    public void ButtonItemZoom4()
    {
        ItemZoom4.SetActive(false);
    }

    public void ButtonItemZoom5()
    {
        ItemZoom5.SetActive(false);
    }

    public void ButtonItemZoom6()
    {
        ItemZoom6.SetActive(false);
    }

    //ズーム全OFF
    public void AllZoomOff()
    {
        ItemZoom1.SetActive(false);
        ItemZoom2.SetActive(false);
        ItemZoom3.SetActive(false);
        ItemZoom4.SetActive(false);
        ItemZoom5.SetActive(false);
        ItemZoom6.SetActive(false);
    }





    //////////トリック関係//////////
    public void PushButtonGoalZoom()
    {
        if (getball == false)
        {
            if (tapball == true)
            {
                getKey();
                getball = true;

            }
            else
            {
                DisplayMessage("ゴールがある、シュートしたくなってきた");
            }
        }
        else
        {

        }

    }

    //カギトリック
    public void PushButtonKeyZoom()
    {
        if (getkey == false)
        {
            if (tapkey == true)
            {
                audioSource.PlayOneShot(key2);
                wallNo = WALL_Deskopen;
                DisplayWall();
                usedkey = true;
                ImageUsed3.SetActive(true);
            }
            else
            {
                audioSource.PlayOneShot(key1);
                DisplayMessage("鍵がかかっている");
            }
        }
        else
        {

        }

    }

    //ドライバートリック
    public void PushButtonUseDrive()
    {
        if (getdriver == false)
        {
            if (tapdriver == true)
            {
                audioSource.PlayOneShot(gatya);
                ButtonUseDriver.SetActive(false);
                ImagePcYoko.SetActive(false);
                ButtonUseParts.SetActive(true);
                useddriver = true;
                ImageUsed2.SetActive(true);
            }
            else
            {
                //DisplayMessage("");
            }
        }
        else
        {

        }
    }

    //パーツトリック
    public void PushButtonUseParts()
    {
        if (getparts == false)
        {
            if (tapparts == true)
            {
                audioSource.PlayOneShot(gatya);
                ImagePutParts.SetActive(true);
                ImagePcOn.SetActive(true);
                ImagePutParts.SetActive(true);
                DisplayWall();
                usedparts = true;
                ImageUsed4.SetActive(true);
                ButtonSinsetu.SetActive(true);
            }
            else
            {
                //DisplayMessage("");
            }
        }
        else
        {

        }
    }

    //電池トリック
    public void FallBattery()
    {
        ButtonFallObama.SetActive(true);
        ButtonObama.SetActive(false);
        DisplayMessage("何か落ちた音がした");
    }

    //ドラムトリック
    public void ButtonHihat()
    {
        audioSource.PlayOneShot(hihat);
        if (howmanytap == 0)
        {
            howmanytap = 1;
        }
        else
        {
            if (howmanytap == 2)
            {
                howmanytap = 3;
            }
            else
            {
                howmanytap = 0;
            }
        }
    }

    public void ButtonSnare()
    {
        audioSource.PlayOneShot(snare);
        if (howmanytap == 1)
        {
            howmanytap = 2;
        }
        else
        {
            if (howmanytap == 4)
            {
                howmanytap = 5;
            }
            else
            {
                if (howmanytap == 12)
                {
                    if (pcOn == true)
                    {
                        FallBattery();
                    }
                    else
                    {
                        DisplayMessage("ズルはいけない");
                        howmanytap = 0;
                    }
                }
                else
                {
                    howmanytap = 0;
                }
            }
        }
    }

    public void ButtonBassDrum()
    {
        audioSource.PlayOneShot(bass);
        if (howmanytap == 3)
        {
            howmanytap = 4;
        }
        else
        {
            if (howmanytap == 6)
            {
                howmanytap = 7;
            }
            else
            {
                howmanytap = 0;
            }
        }
    }

    public void ButtonCymbal2()
    {
        audioSource.PlayOneShot(cymbal2);
        if (howmanytap == 5)
        {
            howmanytap = 6;
        }
        else
        {
            howmanytap = 0;
        }
    }

    public void ButtonTom2()
    {
        audioSource.PlayOneShot(tom2);
        if (howmanytap == 7)
        {
            howmanytap = 8;
        }
        else
        {
            howmanytap = 0;
        }
    }

    public void ButtonCymbal1()
    {
        audioSource.PlayOneShot(cymbal1); 
        if (howmanytap == 8)
        {
            howmanytap = 9;
        }
        else
        {
            howmanytap = 0;
        }

    }

    public void ButtonTom1()
    {
        audioSource.PlayOneShot(tom1);
        if (howmanytap == 9)
        {
            howmanytap = 10;
        }
        else
        {
            howmanytap = 0;
        }
    }

    public void ButtonCymbal3()
    {
        audioSource.PlayOneShot(cymbal3);
        if (howmanytap == 10)
        {
            howmanytap = 11;
        }
        else
        {
            howmanytap = 0;
        }
    }

    public void ButtonTom3()
    {
        audioSource.PlayOneShot (tom3);
        if (howmanytap == 11)
        {
            howmanytap = 12;
        }
        else
        {
            howmanytap = 0;
        }
    }


    //リモコントリック
    public void UseBattery()
    {
        if (getbattery == false)
        {
            if (tapbattery == true)
            {
                audioSource.PlayOneShot(gatya);
                ButtonUseBattery.SetActive(false);
                ImagePw.SetActive(false);
                ButtonPw2.SetActive(true);
                ImagePutBattery.SetActive(true);
                putBattery = true;
                ImageTurnOn.SetActive(true);
                usedbattery = true;
                ImageUsed5.SetActive(true);

            }
            else
            {
                //DisplayMessage("");
            }
        }
        else
        {

        }
    }

    //リモコンのボタン
    public void RimoSwicth()
    {
        if(putBattery == false)
        {
            DisplayMessage("電源が入ってない");
        }
        else
        {
            audioSource.PlayOneShot(gatya);
            ImagePw.SetActive(false);
            ButtonPw2.SetActive(true);
            DisplayMessage("風が吹き始めた");
        }
    }

    //ライトトリック
    public void PushUE()
    {
        audioSource.PlayOneShot(lightbt);
        if (getpw == true)
        {
            if (howmanytap2 == 0)
            {
                howmanytap2++;
            }
            else
            {
                if (howmanytap2 == 4)
                {
                    getCodeno();
                    ImageUsed6.SetActive(true);
                }
                else
                {
                    howmanytap2 = 0;
                }
            }
        }
        else
        {

        }
    }

    public void PushSITA()
    {
        audioSource.PlayOneShot(lightbt);
        if (howmanytap2 == 1)
        {
            howmanytap2++;
        }
        else
        {
            if (howmanytap2 == 2)
            {
                howmanytap2++;
            }
            else
            {
                if (howmanytap2 == 3)
                {
                    howmanytap2++;
                }
                else
                {
                    howmanytap2 = 0;
                }
            }
        }
    }

    //脱出のトリック
    public void PushPlus1()
    {
        audioSource.PlayOneShot(code);
        kari = keta1;
        Plus();
        keta1 = kari;
        strketa1 = kari.ToString();
        changeNo(1, strketa1);
        Escape();
    }

    public void PushPlus2()
    {
        audioSource.PlayOneShot(code);
        kari = keta2;
        Plus();
        keta2 = kari;
        strketa2 = kari.ToString();
        changeNo(2, strketa2);
        Escape();
    }

    public void PushPlus3()
    {
        audioSource.PlayOneShot(code);
        kari = keta3;
        Plus();
        keta3 = kari;
        strketa3 = kari.ToString();
        changeNo(3, strketa3);
        Escape();
    }

    public void PushPlus4()
    {
        audioSource.PlayOneShot(code);
        kari = keta4;
        Plus();
        keta4 = kari;
        strketa4 = kari.ToString();
        changeNo(4, strketa4);
        Escape();
    }

    public void PushMinus1()
    {
        audioSource.PlayOneShot(code);
        kari = keta1;
        Minus();
        keta1 = kari;
        strketa1 = kari.ToString();
        changeNo(1, strketa1);
        Escape();
    }

    public void PushMinus2()
    {
        audioSource.PlayOneShot(code);
        kari = keta2;
        Minus();
        keta2 = kari;
        strketa2 = kari.ToString();
        changeNo(2, strketa2);
        Escape();
    }

    public void PushMinus3()
    {
        audioSource.PlayOneShot(code);
        kari = keta3;
        Minus();
        keta3 = kari;
        strketa3 = kari.ToString();
        changeNo(3, strketa3);
        Escape();
    }

    public void PushMinus4()
    {
        audioSource.PlayOneShot(code);
        kari = keta4;
        Minus();
        keta4 = kari;
        strketa4 = kari.ToString();
        changeNo(4, strketa4);
        Escape();
    }

    public void Plus()
    {
        if (kari < 9)
        {
            kari++;
        }
        else
        {
            kari = 0;
        }
    }

    public void Minus()
    {
        if(kari > 0)
        {
            kari--;
        }
        else
        {
            kari = 9;
        }
    }

    public void changeNo(int KETANO, string NO)
    {
        switch (KETANO)
        {
            case 1:
                KETA1.GetComponent<Text>().text = NO;
                break;
            case 2:
                KETA2.GetComponent<Text>().text = NO;
                break;
            case 3:
                KETA3.GetComponent<Text>().text = NO;
                break;
            case 4:
                KETA4.GetComponent<Text>().text = NO;
                break;
        }
    }

    public void Escape()
    {
        if ((keta1 == 1) && (keta2 == 0) && (keta3 == 2) && (keta4 == 9))
        {
            if (getcode == true)
            {
                audioSource.PlayOneShot(door);
                DisplayMessage("ガチャ");
                Invoke("Clear", 1.5f);
            }
            else
            {
                DisplayMessage("ズルはあかん");
                Invoke("resetCodeNo", 1.5f);
            }
        }
        else
        {
            
        }
    }

    public void resetCodeNo()
    {
        keta1 = 0;
        keta2 = 0;
        keta3 = 0;
        keta4 = 0;
        changeNo(1, "0");
        changeNo(2, "0");
        changeNo(3, "0");
        changeNo(4, "0");
    }

    public void Clear()
    {
        SceneManager.LoadScene("ClearScene");
    }


    //メッセージを表示
    void DisplayMessage(string mes)
    {
        ButtonMessage.SetActive(true);
        ButtonMesageText.GetComponent<Text>().text = mes;
    }

    //メッセージを消す
    public void PushButtonMessage()
    {
        ButtonMessage.SetActive(false);
        AllZoomOff();
    }


    //アイテムの表示する順番の処理
    void itemDisplay(int itemName)
    {
        switch (itemNo)
        {
            case 1://一番目
                switch (itemName)
                {
                    case 1:
                        ButtonItemBall.transform.localPosition = new Vector3(-335.0f, 575.0f, 0.0f);
                        break;
                    case 2:
                        ButtonItemDriver.transform.localPosition = new Vector3(-335.0f, 575.0f, 0.0f);
                        break;
                    case 3:
                        ButtonItemKey.transform.localPosition = new Vector3(-335.0f, 575.0f, 0.0f);
                        break;
                    case 4:
                        ButtonItemParts.transform.localPosition = new Vector3(-335.0f, 575.0f, 0.0f);
                        break;
                    case 5:
                        ButtonItemBattery.transform.localPosition = new Vector3(-335.0f, 575.0f, 0.0f);
                        break;
                    case 6:
                        ButtonItemPw.transform.localPosition = new Vector3(-335.0f, 575.0f, 0.0f);
                        break;
                }
                break;
            case 2://二番目
                switch (itemName)
                {
                    case 1:
                        ButtonItemBall.transform.localPosition = new Vector3(-205.0f, 575.0f, 0.0f);
                        break;
                    case 2:
                        ButtonItemDriver.transform.localPosition = new Vector3(-205.0f, 575.0f, 0.0f);
                        break;
                    case 3:
                        ButtonItemKey.transform.localPosition = new Vector3(-205.0f, 575.0f, 0.0f);
                        break;
                    case 4:
                        ButtonItemParts.transform.localPosition = new Vector3(-205.0f, 575.0f, 0.0f);
                        break;
                    case 5:
                        ButtonItemBattery.transform.localPosition = new Vector3(-205.0f, 575.0f, 0.0f);
                        break;
                    case 6:
                        ButtonItemPw.transform.localPosition = new Vector3(-205.0f, 575.0f, 0.0f);
                        break;
                }
                break;
            case 3://三番目
                switch (itemName)
                {
                    case 1:
                        ButtonItemBall.transform.localPosition = new Vector3(-75.0f, 575.0f, 0.0f);
                        break;
                    case 2:
                        ButtonItemDriver.transform.localPosition = new Vector3(-75.0f, 575.0f, 0.0f);
                        break;
                    case 3:
                        ButtonItemKey.transform.localPosition = new Vector3(-75.0f, 575.0f, 0.0f);
                        break;
                    case 4:
                        ButtonItemParts.transform.localPosition = new Vector3(-75.0f, 575.0f, 0.0f);
                        break;
                    case 5:
                        ButtonItemBattery.transform.localPosition = new Vector3(-75.0f, 575.0f, 0.0f);
                        break;
                    case 6:
                        ButtonItemPw.transform.localPosition = new Vector3(-75.0f, 575.0f, 0.0f);
                        break;
                }
                break;
            case 4://四番目
                switch (itemName)
                {
                    case 1:
                        ButtonItemBall.transform.localPosition = new Vector3(55.0f, 575.0f, 0.0f);
                        break;
                    case 2:
                        ButtonItemDriver.transform.localPosition = new Vector3(55.0f, 575.0f, 0.0f);
                        break;
                    case 3:
                        ButtonItemKey.transform.localPosition = new Vector3(55.0f, 575.0f, 0.0f);
                        break;
                    case 4:
                        ButtonItemParts.transform.localPosition = new Vector3(55.0f, 575.0f, 0.0f);
                        break;
                    case 5:
                        ButtonItemBattery.transform.localPosition = new Vector3(55.0f, 575.0f, 0.0f);
                        break;
                    case 6:
                        ButtonItemPw.transform.localPosition = new Vector3(55.0f, 575.0f, 0.0f);
                        break;
                }
                break;
            case 5://五番目
                switch (itemName)
                {
                    case 1:
                        ButtonItemBall.transform.localPosition = new Vector3(185.0f, 575.0f, 0.0f);
                        break;
                    case 2:
                        ButtonItemDriver.transform.localPosition = new Vector3(185.0f, 575.0f, 0.0f);
                        break;
                    case 3:
                        ButtonItemKey.transform.localPosition = new Vector3(185.0f, 575.0f, 0.0f);
                        break;
                    case 4:
                        ButtonItemParts.transform.localPosition = new Vector3(185.0f, 575.0f, 0.0f);
                        break;
                    case 5:
                        ButtonItemBattery.transform.localPosition = new Vector3(185.0f, 575.0f, 0.0f);
                        break;
                    case 6:
                        ButtonItemPw.transform.localPosition = new Vector3(185.0f, 575.0f, 0.0f);
                        break;
                }
                break;
            case 6://六番目
                switch (itemName)
                {
                    case 1:
                        ButtonItemBall.transform.localPosition = new Vector3(315.0f, 575.0f, 0.0f);
                        break;
                    case 2:
                        ButtonItemDriver.transform.localPosition = new Vector3(315.0f, 575.0f, 0.0f);
                        break;
                    case 3:
                        ButtonItemKey.transform.localPosition = new Vector3(315.0f, 575.0f, 0.0f);
                        break;
                    case 4:
                        ButtonItemParts.transform.localPosition = new Vector3(315.0f, 575.0f, 0.0f);
                        break;
                    case 5:
                        ButtonItemBattery.transform.localPosition = new Vector3(315.0f, 575.0f, 0.0f);
                        break;
                    case 6:
                        ButtonItemPw.transform.localPosition = new Vector3(315.0f, 575.0f, 0.0f);
                        break;
                }
                break;
        }
    }

   
}
