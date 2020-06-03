
import os

########################2e-5######################
#[case 25] batch_size = 16 / learning_rate = 5e-5 / epochs = 22.0
os.system('python run_ner.py --data_dir=data --task_name="NER" --vocab_file=C:/Users/cine/Desktop/HanBert-54kN/conf_base/vocab_54k.txt --bert_config_file=C:/Users/cine/Desktop/HanBert-54kN/conf_base/bert_config.json --do_lower_case=False --crf=False --do_train=False --do_eval=True --do_predict=True --output_dir=./output/NER_output_b16_lr5e-5_e22_w5 --max_seq_length=128 --train_batch_size=16 --learning_rate=5e-5 --num_train_epochs=22.0 --init_checkpoint=C:/Users/cine/Desktop/HanBert-54kN/p_model_base/model.ckpt-3000000 &')
