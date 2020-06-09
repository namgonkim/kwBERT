# KW BERT
2019-2020 산학연계SW프로젝트<br>
개체명 인식기 개발<br>
광운대학교 컴퓨터정보공학부<br>

* 참여기업
   - 한화시스템<br>

 * 참여인원
   - 교수 이혁준<br>
   - 조교 이지훈<br>
   - 조장 송광원<br>
   - 조원 김남곤<br>
   - 조원 안승기<br>
   - 조원 부상혁<br>

![참여기업_학교](https://user-images.githubusercontent.com/32921225/84117136-00830d80-aa6c-11ea-9e22-b4e8e75f3225.png)

## 목표
인공지능 기반 자연어 처리 기술을 이용한 개체명 인식기 개발 <br>


## 전체 시스템 구조도
![system_model](https://user-images.githubusercontent.com/32921225/83033390-02170380-a072-11ea-9156-89edb5b49521.png)
1. Training Module <br>
2. Input & Preprocess Module <br>
3. Running Module <br>
4. Output Module <br>
5. Web & Web Server(PHP & Apache) <br>


## 실행환경
 * OS : Windows 10 <br>
 * GPU : RTX2080 8GB <br>
 * RAM : 32GB <br>
 * Python : 3.6.8rc1 <br>
 * Tensorflow-gpu : 1.12.0 <br>
 * CUDA : 9.0 <br>


## 한국어 데이터
 * 엑소브레인 한국어 말뭉치 데이터 <br>
 * 네이버 NLP 챌린지 말뭉치 데이터 <br>
 * 국립국어원 개체명 말뭉치 데이터 <br>

## Hyper Parameters

| 파라미터       | 값       |
| ------------- | -------- |
| Epoch         | **20**   |
| Batch Size    | **16**   |
| Learning Rate | **5e-5** |


## Result

|            | Score(%)    |
| ---------- | ----------- |
| Precision  | **85.21**   |
| Recall     | **84.83**   |
| F1         | **85.01**   |


## Result-Screen
 * Input.php
![input](https://user-images.githubusercontent.com/32921225/83036974-2ffe4700-a076-11ea-8589-af40547d20d2.png)
 * Result.php
![result](https://user-images.githubusercontent.com/32921225/83036984-312f7400-a076-11ea-99a9-17470cbb4e8f.PNG)
 * Theme
   - https://startbootstrap.com/themes/sb-admin-2/


## Reference

1) Google-bert (https://github.com/google-research/bert)
 * BERT-base <br>

2) Hanbert (https://github.com/tbai2019/HanBert-54k-N)
 * HanBert-54kN : HanBert 기본 모델 (300만 Step 학습) <br>
   - bert_config.json <br>
   - checkpoint <br>
   - model.ckpt-3000000.data-00000-of-00001 <br>
   - model.ckpt-3000000.meta <br>
   - model.ckpt-3000000.index <br>
   - vocab_54k.txt <br>

3) T-Academy 김성현 BERT
 * https://drive.google.com/drive/folders/1QQphR2tmk5g6BheZKZ5q8WhX5yixV8xZ
 
Thank you :)
