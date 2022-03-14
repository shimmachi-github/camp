using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class ClearManager : MonoBehaviour {


    public AudioClip clear;

    private AudioSource audioSource;
    // Use this for initialization
    void Start () {
        
    }
	
	// Update is called once per frame
	void Update () {

	}

    public void Clear()
    {
        audioSource.PlayOneShot(clear);
    }
    

    public void PushBackButton()
    {
        SceneManager.LoadScene("TitleScene");
    }
}
