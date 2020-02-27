######################################## json 파일에서 형태소 추출코드 ############################################
# import json
# import os
# import sys

# os.chdir(os.getcwd())

# file = os.listdir(os.getcwd())

# for filename in file :

#    if 'json' in filename :

#        sys.stdout = open(filename[:-5] + ".txt", "w", -1, "utf-8")
#        with open(filename, 'rt',-1, "utf-8") as json_file:
#            json_data = json.load(json_file)

#        for j in range(0,len(json_data["sentence"])):
#            #for i in range(0,len(json_data["sentence"][j]["morp"])):
#            for i in range(0,len(json_data["sentence"][j]["dependency"])):
#                #json_lemma = json_data["sentence"][j]["morp"][i]["lemma"]
#                json_lemma = json_data["sentence"][j]["dependency"][i]["text"]
#                #json_type = json_data["sentence"][j]["morp"][i]["type"]
#                json_type = json_data["sentence"][j]["dependency"][i]["label"]
#                print(json_lemma + "\t" + json_type)
#            print("\n")
###############################################################################################################

####################################### 엑소브레인 데이터 개체명 추출 코드 ###########################################
import os
import sys
import mecab

os.chdir(os.getcwd())
mecab = mecab.MeCab()

sys.stdout = open("NEW_EXOBRAIN_NE_CORPUS_10000.txt", "w", -1, "utf-8")
f = open("EXOBRAIN_NE_CORPUS_10000.txt", "rt", -1, "utf-8")

while True:
    line = f.readline()
    if not line:
        break

    tokened_str = mecab.morphs(line)

    check = 0
    lemma = []
    type = []

    for i in range(0,len(tokened_str)):

       if '<' in tokened_str[i] :
           check = 1
       elif check == 0:
           print(tokened_str[i] + "\t0")
       elif check==1:
               lemma.append(tokened_str[i])
               if (i + 1) <= len(tokened_str):
                   if ':' in tokened_str[i+1]:
                        check=2
       elif check==2:
           check = 3
       elif check==3:
           type.append(tokened_str[i])
           if (i + 1) <= len(tokened_str):
               if '>' in tokened_str[i+1]:
                    check=4
                    print("".join(lemma) + "\t" + "".join(type))
                    lemma = []
                    type = []
       elif check==4:
           check = 0

    print("\n")

###############################################################################################################